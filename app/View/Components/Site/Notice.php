<?php

declare(strict_types=1);

namespace App\View\Components\Site;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Notice extends Component
{
    public string $color;

    public ?string $text = null;

    public function __construct()
    {
        $this->color = color_var(settings('site-notice.color'), 'primary');

        $this->text = localized_settings('site-notice.text');
    }

    public function render(): View
    {
        return view('components.site.notice');
    }

    /**
     * Determine if the component should be rendered.
     *
     * @return bool
     */
    public function shouldRender(): bool
    {
        return (bool) settings('site-notice.enabled');
    }
}
