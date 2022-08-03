<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\HasUuid;
use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormSubmission extends Model
{
    use Filterable;
    use HasFactory;
    use Sortable;
    use HasUuid;

    public array $allowedSorts = [
        'id',
    ];

    public array $allowedFilters = [
        //
    ];

    protected $fillable = [
        'data',
    ];

    public $casts = [
        'data' => 'array',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }
}
