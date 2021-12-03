<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

class Text extends BlockComponent
{
    public ?string $title;

    public ?string $html = null;

    public function setup(): void
    {
        $this->title = $this->block->translatedInput('title');

        $this->html = $this->block->translatedInput('text');
    }
}
