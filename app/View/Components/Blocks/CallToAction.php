<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

class CallToAction extends BlockComponent
{
    public ?string $title;

    public ?string $html = null;

    public bool $fullwidth;

    public function setup(): void
    {
        $this->title = $this->block->translatedInput('title');

        $this->html = $this->block->translatedInput('text');

        $this->fullwidth = $this->block->checkbox('fullwidth');
    }
}
