<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Block;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Blocks extends Component
{
    public Collection $blocks;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->blocks = $model->blocks
            ->whereNull('parent_id')
            ->filter(fn (Block $block) => view()->exists("components.blocks.{$block->type}"));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks');
    }
}
