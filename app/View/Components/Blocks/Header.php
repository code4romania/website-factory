<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use App\Models\Block;
use Illuminate\View\Component;

class Header extends Component
{
    public ?string $title;

    public ?string $text;

    public bool $center;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Block $block)
    {
        $this->title = $block->translatedInput('title');

        $this->text = $block->translatedInput('text');

        $this->center = $block->input('align') === 'center';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.header');
    }
}
