<?php

declare(strict_types=1);

namespace App\View\Components\Site;

use App\Models\Partner;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Partners extends Component
{
    public Collection $partners;

    public function __construct()
    {
        $this->partners = Partner::query()
            ->withMediaAndVariants()
            ->whereHasMedia('image')
            ->get();
    }

    public function render(): View
    {
        return view('components.site.partners');
    }

    public function shouldRender(): bool
    {
        return $this->partners->isNotEmpty();
    }
}
