<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use App\Models\Media;

class HeroBgImage extends BlockComponent
{
    public ?string $title;

    public ?string $text;

    public ?Media $image;

    public ?string $button_url;

    public ?string $button_text;

    public function setup(): void
    {
        $this->title = $this->block->translatedInput('title');

        $this->text = $this->block->translatedInput('text');

        $this->image = $this->block->firstMedia('image');

        $this->button_url = $this->block->translatedInput('button_url');

        $this->button_text = $this->block->translatedInput('button_text');
    }
}
