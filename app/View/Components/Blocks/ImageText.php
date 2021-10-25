<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use App\Models\Block;
use App\Models\Media;
use Illuminate\View\Component;

class ImageText extends Component
{
    public ?string $title;

    public ?string $html = null;

    public ?Media $image;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Block $block)
    {
        $this->title = $block->translatedInput('title');

        $this->html = $block->translatedInput('text');

        $this->image = $block->firstMedia('image');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.image-text');
    }
}
