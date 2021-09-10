<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Block;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasBlocks
{
    public function initializeHasBlocks(): void
    {
        $this->fillable[] = 'blocks';
    }

    public function blocks(): MorphMany
    {
        return $this->morphMany(Block::class, 'blockable')
            ->orderBy('blocks.position');
    }

    public function setBlocksAttribute(iterable $blocks): void
    {
        $this->blocks()->delete();

        $this->blocks()->createMany(
            collect($blocks)->map(function (array $block, int $index) {
                $block['blockable_id'] = $this->id;
                $block['blockable_type'] = $this->getMorphClass();
                $block['position'] = $index + 1;

                return $block;
            })
        );
    }
}
