<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use App\Models\Media;

class ImageText extends BlockComponent
{
    public ?string $title;

    public ?string $html = null;

    public ?Media $image;

    public function setup(): void
    {
        $this->title = $this->block->translatedInput('title');

        $this->html = $this->block->translatedInput('text');

        $this->image = $this->block->firstMedia('image');
    }
}
