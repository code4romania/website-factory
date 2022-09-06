<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Related extends Pivot
{
    protected $primaryKey = null;

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
        return $this->morphTo('related');
    }

    public function subject(): MorphTo
    {
        return $this->morphTo('subject');
    }
}
