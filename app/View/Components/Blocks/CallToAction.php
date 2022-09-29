<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

class CallToAction extends BlockComponent
{
    public ?string $title;

    public ?string $color;

    public ?string $html;

    public ?string $button_url;

    public ?string $button_text;

    public function setup(): void
    {
        $this->title = $this->block->translatedInput('title');

        $this->color = $this->block->input('color');

        $this->html = $this->block->translatedInput('text');

        $this->button_url = $this->block->translatedInput('button_url');

        $this->button_text = $this->block->translatedInput('button_text');
    }
}
