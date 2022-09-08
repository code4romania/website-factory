<?php

declare(strict_types=1);

namespace App\View\Components\Site;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Meta extends Component
{
    public ?string $title;

    public ?string $description;

    public ?string $type;

    public ?string $site;

    public ?string $image;

    public ?string $url;

    public function __construct()
    {
        $this->title = $this->sanitize('title');
        $this->description = $this->sanitize('description');
        $this->type = seo('type') ?? 'website';
        $this->site = seo('site');
        $this->image = seo('image');
        $this->url = seo('url');
    }

    public function render(): View
    {
        return view('components.site.meta');
    }

    protected function sanitize(?string $key): ?string
    {
        return Str::of(seo($key))
            ->stripTags()
            ->toString();
    }
}
