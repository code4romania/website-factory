<?php

declare(strict_types=1);

namespace App\View\Components\Site;

use App\Models\Page;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CookieNotice extends Component
{
    public ?string $privacyPolicyUrl = null;

    public function __construct()
    {
        $this->privacyPolicyUrl = Page::find(settings('site.privacy_page'))?->url;
    }

    public function render(): View
    {
        return view('components.site.cookie-notice');
    }
}
