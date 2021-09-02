<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Block;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasBlocks
{
    public function blocks(): MorphMany
    {
        return $this->morphMany(Block::class, 'blockable')->orderBy('blocks.position');
    }

    public function renderBlocks()
    {
        //
    }

    private function getBlockView(string $type): string
    {
        return 'public.blocks' . '.' . $type;
    }
}
