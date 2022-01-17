<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    use SEOTools;

    public function index(): View
    {
        $front_page = settings('site.front_page');

        \abort_unless($front_page, 404);

        return view('front.pages.default', [
            'page' => Page::query()
                ->with('blocks.media')
                ->findOrFail($front_page),
        ]);
    }

    public function show(string $locale, Page $page): View
    {
        $image = $page->firstMedia('image');

        $this->seo()
            ->setTitle($page->title)
            ->setDescription($page->description)
            ->addImages(
                optional($image)->getUrl()
            );

        $page->loadMissing('blocks.media');

        return $page->view([
            'page'  => $page,
            'image' => $image,
        ]);
    }
}
