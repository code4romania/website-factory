<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PageController extends Controller
{
    use SEOTools;

    public function index(): View
    {
        $frontPage = settings('site.front_page');

        abort_unless($frontPage, 404);

        $page = Page::query()
            ->with('blocks.media')
            ->findOrFail($frontPage);

        $image = $page->firstMedia('image');

        $this->seo()
            ->setTitle($page->title)
            ->setDescription($page->description)
            ->addImages($image?->getUrl());

        return $page->view([
            'page'  => $page,
            'image' => $image,
        ]);
    }

    public function show(string $locale, Page $page): RedirectResponse|View
    {
        // Redirect to home if set as front page
        if ($page->id === settings('site.front_page')) {
            return redirect()->route('front.pages.index', ['locale' => $locale]);
        }

        $image = $page->firstMedia('image');

        $this->seo()
            ->setTitle($page->title)
            ->setDescription($page->description)
            ->addImages($image?->getUrl());

        $page->loadMissing('blocks.media');

        return $page->view([
            'page'  => $page,
            'image' => $image,
        ]);
    }
}
