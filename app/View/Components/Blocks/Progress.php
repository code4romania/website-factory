<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

class Progress extends BlockComponent
{
    public ?string $icon;

    public ?string $title;

    public ?string $description;

    public int $progress;

    public ?string $buttonText;

    public ?string $buttonUrl;

    public function setup(): void
    {
        $this->title = $this->block->translatedInput('title');

        $this->description = $this->block->translatedInput('description');

        $this->icon = $this->iconComponent($this->block->input('icon'));

        $this->progress = (int) $this->block->input('progress');

        $this->buttonText = $this->block->translatedInput('button_text');
        $this->buttonUrl = $this->block->translatedInput('button_url');
    }
}
