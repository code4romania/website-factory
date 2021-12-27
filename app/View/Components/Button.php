<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public ?string $href;

    public string $element;

    public string $size;

    public ?string $icon;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $href = null, ?string $size = 'md', ?string $icon = null)
    {
        $this->element = ! \is_null($href) ? 'a' : 'button';

        $this->href = $href;

        if (! \in_array($size, ['xs', 'sm', 'md', 'lg', 'xl'])) {
            $size = 'md';
        }

        $this->size = $size;

        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button');
    }

    public function class(): string
    {
        $class = collect('flex items-center w-full font-semibold sm:inline-flex sm:w-auto focus:outline-none focus:ring-2 focus:ring-offset-2');

        $class->push(match ($this->size) {
            'xs' => 'px-2.5 py-1.5 shadow-sm text-xs rounded',
            'sm' => 'px-3 py-2 text-sm leading-4 rounded-md shadow-sm',
            'md' => 'px-4 py-2 text-sm rounded-md shadow-sm',
            'lg' => 'px-4 py-2 text-base rounded-md shadow-sm',
            'xl' => 'px-6 py-3 text-base rounded-md shadow-sm',
            default => '',
        });

        return $class->join(' ');
    }

    public function iconClass(): string
    {
        return match ($this->size) {
            'xs' => '-ml-0.5 mr-2 h-4 w-4',
            'sm' => '-ml-0.5 mr-2 h-4 w-4',
            'md' => '-ml-1 mr-2 h-5 w-5',
            'lg' => '-ml-1 mr-3 h-5 w-5',
            'xl' => '-ml-1 mr-3 h-5 w-5',
            default => '',
        };
    }
}
