<?php

declare(strict_types=1);

namespace App\View\Components\Site;

use App\Models\MenuItem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Footer extends Component
{
    public Collection $menu;

    public string $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->menu = $this->getMenuItems();

        $this->title = app('seotools')->getTitle();
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

    private function getMenuItems(): Collection
    {
        return Cache::rememberForever('menu-footer', function () {
            return MenuItem::query()
                ->location('footer')
                ->get()
                ->toTree();
        });
    }
}
