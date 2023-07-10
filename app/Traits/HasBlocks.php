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

    private function createBlocks(iterable $blocks, ?Block $parent = null)
    {
        $blocks = collect($blocks)->map(fn (array $block, int $index) => [
            'blockable_id' => $this->id,
            'blockable_type' => $this->getMorphClass(),
            'position' => $index + 1,
            'type' => $block['type'],
            'content' => $block['content'] ?? [],
            'children' => $block['children'] ?? [],
            'media' => collect($block['media'] ?? [])->pluck('id')->all(),
            'related' => $block['related'] ?? [],
        ]);

        $target = $parent ? $parent->children() : $this->blocks();

        $target->createMany($blocks)
            ->each(function (Block $block) use ($blocks) {
                $parent = $blocks
                    ->where('type', $block->type)
                    ->firstWhere('position', $block->position);

                $block->attachMedia($parent['media'], ['image']);

                $block->saveRelated($parent['related']);

                if (! empty($parent['children'])) {
                    $this->createBlocks($parent['children'], $block);
                }
            });
    }

    public function saveBlocks(iterable $blocks): Model
    {
        $this->blocks->map->delete();

        $this->createBlocks($blocks);

        return $this;
    }
}
