<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use Illuminate\Support\Collection;

class DecisionTree extends BlockComponent
{
    public ?string $title;

    public ?string $html = null;

    public Collection $items;

    public function setup(): void
    {
        $this->title = $this->block->translatedInput('title');

        $this->items = $this->block->children;

        $this->html = $this->block->translatedInput('text');
    }
}
