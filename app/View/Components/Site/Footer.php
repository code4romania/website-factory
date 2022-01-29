<?php

declare(strict_types=1);

namespace App\View\Components\Site;

use App\Models\MenuItem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Footer extends Component
{
    public string $title;

    public Collection $menu;

    public array $social;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->title = localized_settings('site.title');

        $this->menu = Cache::rememberForever(
            'menu-footer',
            fn () => MenuItem::query()
                ->location('footer')
                ->get()
                ->toTree()
        );

        $this->social = settings('site.social');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.site.footer');
    }
}
