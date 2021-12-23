<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Related extends Model
{
    protected $primaryKey = null;

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'related_type',
        'related_id',
        'subject_type',
        'subject_id',
        'position',
    ];

    protected $with = [
        'related',
    ];

    public function related(): MorphTo
    {
        return $this->morphTo('related')
            ->orderBy('related.position');
    }

    public function subject(): MorphTo
    {
        return $this->morphTo('subject');
    }
}
