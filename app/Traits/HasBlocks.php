<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Block;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasBlocks
{
    public function blocks(): MorphMany
    {
        return $this->morphMany(Block::class, 'blockable')
            ->whereNull('parent_id')
            ->orderBy('blocks.position');
    }

    public function saveBlocks(iterable $blocks): void
    {
        $this->blocks()->delete();

        $blocks = collect($blocks)->map(fn (array $block, int $index) => [
            'blockable_id'   => $this->id,
            'blockable_type' => $this->getMorphClass(),
            'position'       => $index + 1,
            'type'           => $block['type'],
            'content'        => $block['content'] ?? [],
            'children'       => $block['children'] ?? [],
            'media'          => collect($block['media'] ?? [])->pluck('id')->all(),
        ]);

        $this->blocks()->createMany($blocks)
            ->each(function (Block $block) use ($blocks) {
                $block->children()->createMany(
                    $blocks
                        ->where('type', $block->type)
                        ->where('position', $block->position)
                        ->pluck('children')
                        ->flatten(1)
                        ->map(fn (array $block, int $index) => [
                            'blockable_id'   => $this->id,
                            'blockable_type' => $this->getMorphClass(),
                            'position'       => $index + 1,
                            'type'           => $block['type'],
                            'content'        => $block['content'] ?? [],
                        ])
                );

                $block->attachMedia(
                    $blocks->where('type', $block->type)
                        ->where('position', $block->position)
                        ->pluck('media')
                        ->first(),
                    ['image']
                );
            });
    }
}
