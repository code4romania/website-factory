<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Language extends Model
{
    use ClearsResponseCache;
    use HasFactory;

    public $incrementing = false;

    public $timestamps = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'code';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    protected $fillable = [
        'code',
        'name',
        'enabled',
        'lines',
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    public function setLinesAttribute(array $input): void
    {
        $lines = collect(LanguageLine::all(['group', 'key', 'text'])->toArray())
            ->map(function (array $line) use ($input) {
                $line['text'][$this->code] = $input[$line['key']] ?? __($line['key']);

                $line['text'] = json_encode($line['text']);

                return $line;
            })
            ->all();

        LanguageLine::upsert($lines, ['group', 'key'], ['text']);

        Cache::flush();
        static::clearResponseCache();
    }
}
