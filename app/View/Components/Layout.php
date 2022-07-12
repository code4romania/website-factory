<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;

class Layout extends Component
{
    public ?string $headerHtml;

    public ?string $footerHtml;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->headerHtml = settings('site.html.header');

        $this->footerHtml = settings('site.html.footer');
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
