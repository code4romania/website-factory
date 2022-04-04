<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Block;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasBlocks
{
    public function blocks(): MorphMany
    {
        return $this->morphMany($this->blockable ?? Block::class, 'blockable')
            ->whereNull('parent_id')
            ->orderBy('blocks.position');
    }

    public function saveBlocks(iterable $blocks): Model
    {
        $this->blocks->map->delete();

        $blocks = collect($blocks)->map(fn (array $block, int $index) => [
            'blockable_id'   => $this->id,
            'blockable_type' => $this->getMorphClass(),
            'position'       => $index + 1,
            'type'           => $block['type'],
            'content'        => $block['content'] ?? [],
            'children'       => $block['children'] ?? [],
            'media'          => collect($block['media'] ?? [])->pluck('id')->all(),
            'related'        => collect($block['related'] ?? [])->pluck('id')->all(),
        ]);

        $this->blocks()->createMany($blocks)
            ->each(function (Block $block) use ($blocks) {
                $currentBlock = $blocks
                    ->where('type', $block->type)
                    ->firstWhere('position', $block->position);

                $children = collect($currentBlock['children'])
                    ->map(fn (array $block, int $index) => [
                        'blockable_id'   => $this->id,
                        'blockable_type' => $this->getMorphClass(),
                        'position'       => $index + 1,
                        'type'           => $block['type'],
                        'content'        => $block['content'] ?? [],
                        'children'       => $block['children'] ?? [],
                        'media'          => collect($block['media'] ?? [])->pluck('id')->all(),
                        'related'        => collect($block['related'] ?? [])->pluck('id')->all(),
                    ]);

                $block->children()->createMany($children)
                    ->each(function (Block $block) use ($children) {
                        $currentBlock = $children
                            ->where('type', $block->type)
                            ->firstWhere('position', $block->position);

                        $block->attachMedia($currentBlock['media'], ['image']);

                        $block->saveRelated($currentBlock['related']);
                    });

                $block->attachMedia($currentBlock['media'], ['image']);

                $block->saveRelated($currentBlock['related']);
            });

        return $this;
    }
}
