<?php

declare(strict_types=1);

namespace App\View\Components\Site;

use App\Models\MenuItem;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class Header extends Component
{
    public ?string $logo;

    public ?string $title;

    public Collection $menu;

    public function __construct()
    {
        $this->logo = settings('site.logo')
            ? Storage::url(settings('site.logo'))
            : null;

        $this->title = localized_settings('site.title');

        $this->menu = Cache::rememberForever(
            'menu-header',
            fn () => MenuItem::query()
                ->location('header')
                ->get()
                ->toTree()
        );
    }

    public function render(): View
    {
        return view('components.site.header');
    }
}
