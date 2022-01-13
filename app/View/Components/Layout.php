<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Layout extends Component
{
    public string $colors;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->colors = collect(settings('site.colors'))
            ->map(
                fn (string $value, string $key) => \sprintf(
                    '--color-%s: %s;',
                    $key,
                    Str::between($value, 'rgb(', ')')
                )
            )
            ->implode(' ');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout');
    }
}
