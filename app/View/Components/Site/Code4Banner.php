<?php

declare(strict_types=1);

namespace App\View\Components\Site;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Code4Banner extends Component
{
    public function render(): View
    {
        return view('components.site.code4banner');
    }

    public function shouldRender(): bool
    {
        return ! config('website-factory.hide_code4banner');
    }
}
