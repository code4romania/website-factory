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

    public function containerColumns(): string
    {
        return match ($this->block->input('width')) {
            '25%' => 'md:grid-cols-4',
            '33%' => 'md:grid-cols-3',
            '50%' => 'md:grid-cols-2',
            default => '',
        };
    }

    public function containerAlign(): string
    {
        return match ($this->block->input('align')) {
            'top' => 'items-start',
            'center' => 'items-center',
            'bottom' => 'items-end',
            default => '',
        };
    }

    public function imageColumns(): string
    {
        if ($this->block->input('position') !== 'right') {
            return '';
        }

        return match ($this->block->input('width')) {
            '25%' => 'md:col-start-4',
            '33%' => 'md:col-start-3',
            '50%' => 'md:col-start-2',
            default => '',
        };
    }

    public function contentColumns(): string
    {
        return match ($this->block->input('width')) {
            '25%' => 'md:col-span-3',
            '33%' => 'md:col-span-2',
            '50%' => 'md:col-span-1',
            default => '',
        };
    }
}
