<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use Illuminate\Support\Collection;

class DecisionTree extends BlockComponent
{
    public Collection $items;

    public function setup(): void
    {
        $this->items = $this->block->children;
    }
}
