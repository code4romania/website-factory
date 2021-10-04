<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use App\Models\Block;
use Illuminate\View\Component;

class CallToAction extends Component
{
    public ?string $title;

    public ?string $html = null;

    public bool $fullwidth;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Block $block)
    {
        $this->title = $block->translatedInput('title');

        $this->html = $block->translatedInput('text');

        $this->fullwidth = $block->checkbox('fullwidth');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.call-to-action');
    }
}
