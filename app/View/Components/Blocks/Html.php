<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

class Html extends BlockComponent
{
    public ?string $code;

    public ?string $title = null;

    public string $aspectRatio;

    public function setup(): void
    {
        $this->title = $this->block->translatedInput('title');

        $this->code = $this->block->input('code');

        $this->aspectRatio = match ($this->block->input('aspect_ratio')) {
            '1/1'   => 'aspect-w-1 aspect-h-1',
            '5/4'   => 'aspect-w-5 aspect-h-4',
            '4/3'   => 'aspect-w-4 aspect-h-3',
            '3/2'   => 'aspect-w-3 aspect-h-2',
            '5/3'   => 'aspect-w-5 aspect-h-3',
            '16/9'  => 'aspect-w-16 aspect-h-9',
            '2/1'   => 'aspect-w-2 aspect-h-1',
            '3/1'   => 'aspect-w-3 aspect-h-1',
            '5/6'   => 'aspect-w-5 aspect-h-6',
            '4/5'   => 'aspect-w-4 aspect-h-5',
            '3/4'   => 'aspect-w-3 aspect-h-4',
            '2/3'   => 'aspect-w-2 aspect-h-3',
            '3/5'   => 'aspect-w-3 aspect-h-5',
            '9/16'  => 'aspect-w-9 aspect-h-16',
            '1/2'   => 'aspect-w-1 aspect-h-2',
            '1/3'   => 'aspect-w-1 aspect-h-3',
            default => '',
        };
    }
}
