<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use App\Models\Block;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

abstract class BlockComponent extends Component
{
    protected Block $block;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    final public function __construct(Block $block)
    {
        $this->block = $block;

        $this->setup();
    }

    /**
     * Set up component properties.
     *
     * @return void
     */
    abstract public function setup(): void;

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    final public function render(): View
    {
        if (view()->exists("components.blocks.{$this->block->type}")) {
            return view("components.blocks.{$this->block->type}");
        }

        return view('components.blocks._missing', [
            'path' => "resources/views/{$this->block->type}.blade.php",
        ]);
    }

    protected function columnsFromInput(string $name = 'columns'): string
    {
        $count = (int) $this->block->input($name);

        return match ($count) {
            default => 'md:grid-cols-1',
            2 => 'md:grid-cols-2',
            3 => 'md:grid-cols-3',
            4 => 'md:grid-cols-2 lg:grid-cols-4',
            5 => 'md:grid-cols-3 lg:grid-cols-5',
        };
    }
}
