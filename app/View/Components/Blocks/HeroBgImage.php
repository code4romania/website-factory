<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use App\Models\Media;

class HeroBgImage extends BlockComponent
{
    public ?string $title;

    public ?string $text;

    public ?Media $image;

    public function setup(): void
    {
        $this->title = $this->block->translatedInput('title');

        $this->text = $this->block->translatedInput('text');

        $this->image = $this->block->firstMedia('image');
    }
}
