<?php

declare(strict_types=1);

namespace App\View\Components\Site;

use App\Models\MenuItem;
use App\Services\Features;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Footer extends Component
{
    public ?string $title;

    public Collection $menu;

    public ?array $social;

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

        $this->social = settings('social.profiles');
    }

    public function render(): View
    {
        if (config('website-factory.edition') === 'minister') {
            return view('components.site.footer-minister');
        }

        return view('components.site.footer');
    }

    public function banner(): ?string
    {
        if (Features::isCode4RomaniaSite()) {
            return null;
        }

        return __('banner.external', [
            'edition' => __('banner.edition.' . config('website-factory.edition')),
        ]);
    }
}
