<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class SocialMediaLinks extends Component
{
    public Collection $links;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?array $links = [])
    {
        $this->links = collect(config('website-factory.social_platforms'))
            ->map(function (array $platform, string $id) use ($links) {
                $platform['value'] = $links[$id] ?? null;

                return $platform;
            })
            ->reject(fn (array $link) => \is_null($link['value']));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.social-media-links');
    }
}
