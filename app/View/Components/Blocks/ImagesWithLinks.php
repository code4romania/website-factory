<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use App\Models\Block;
use Illuminate\Support\Collection;

class ImagesWithLinks extends BlockComponent
{
    public ?string $title;

    public ?string $description;

    public Collection $items;

    public string $columns;

    public function setup(): void
    {
        $this->title = $this->block->translatedInput('title');

        $this->description = $this->block->translatedInput('description');

        $this->columns = $this->columnsFromInput();

        $this->items = $this->block->children
            ->loadMissing('media')
            ->map(fn (Block $block) => [
                'url'     => $block->translatedInput('url'),
                'caption' => $block->translatedInput('caption'),
                'image'   => $block->firstMedia('image'),
            ]);
    }
}
