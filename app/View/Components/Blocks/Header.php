<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

class Header extends BlockComponent
{
    public ?string $title;

    public ?string $text;

    public bool $center;

    public function setup(): void
    {
        $this->title = $this->block->translatedInput('title');

        $this->text = $this->block->translatedInput('text');

        $this->center = $this->block->input('align') === 'center';
    }
}
