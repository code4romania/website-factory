<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Related;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasRelated
{
    public static function bootHasRelated(): void
    {
        static::deleting(function (Model $model) {
            $model->related()->delete();
        });
    }

    public function related(): MorphMany
    {
        return $this->morphMany(Related::class, 'subject')
            ->orderBy('position');
    }

    public function saveRelated(array $items): void
    {
        $this->related()->createMany(
            collect($items)->map(fn ($item, int $index) => [
                'related_id'   => $item,
                'related_type' => 'person',
                'position'     => $index + 1,
            ])
        );
    }
}
