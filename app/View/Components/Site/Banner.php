<?php

declare(strict_types=1);

namespace App\View\Components\Site;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Banner extends Component
{
    public function render(): View
    {
        return view('components.site.banner');
    }

    public function shouldRender(): bool
    {
        return ! config('website-factory.hide_banner');
    }
}
