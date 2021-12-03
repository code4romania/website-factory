<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostCategoryController extends Controller
{
    use SEOTools;

    public function index(): RedirectResponse
    {
        return redirect()->route('front.posts.index');
    }

    public function show(string $locale, PostCategory $postCategory): View
    {
        $this->seo()
            ->setTitle($postCategory->title)
            ->setDescription($postCategory->description);

        return view('front.posts.category', [
            'category' => $postCategory,
            'posts'    => $postCategory
                ->posts()
                ->with('media')
                ->paginate(12),
        ]);
    }
}
