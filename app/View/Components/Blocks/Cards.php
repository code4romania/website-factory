<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use Illuminate\Support\Collection;

class Cards extends BlockComponent
{
    public ?string $title;

    public Collection $items;

    public string $columns;

    public function setup(): void
    {
        $this->title = $this->block->translatedInput('title');

        $this->items = $this->block->children;

        $this->columns = $this->columnsFromInput();
    }
}
