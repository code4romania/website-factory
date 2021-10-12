<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use App\Models\Block;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Accordion extends Component
{
    public ?string $title;

    public Collection $items;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Block $block)
    {
        $this->title = $block->translatedInput('title');

        $this->items = $block->children;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.accordion');
    }
}
