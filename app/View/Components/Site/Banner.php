<?php

declare(strict_types=1);

namespace App\View\Components\Site;

use App\Services\Features;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Banner extends Component
{
    public ?string $text;

    public bool $isExternalSite;

    public function __construct(?string $text = null)
    {
        $this->text = $text;

        $this->isExternalSite = ! Features::isCode4RomaniaSite();
    }

    public function render(): View
    {
        if (Features::isSchoolSite()) {
            return view('components.site.banner-school');
        }

        return view('components.site.banner');
    }

    public function shouldRender(): bool
    {
        return ! config('website-factory.hide_banner') && ! \is_null($this->text);
    }
}
