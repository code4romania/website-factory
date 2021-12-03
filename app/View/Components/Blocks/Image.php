<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use App\Models\Media;

class Image extends BlockComponent
{
    public ?string $title;

    public ?Media $image;

    public function setup(): void
    {
        $this->title = $this->block->translatedInput('title');

        $this->image = $this->block->firstMedia('image');
    }
}
