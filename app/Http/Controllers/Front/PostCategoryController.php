<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostCategoryController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('front.posts.index');
    }

    public function show(string $locale, PostCategory $postCategory): View
    {
        seo()
            ->title((string) $postCategory->title)
            ->description((string) $postCategory->description);

        return view('front.posts.category', [
            'category' => $postCategory,
            'posts' => $postCategory
                ->posts()
                ->with(['categories', 'media'])
                ->latest('published_at')
                ->paginate(12),
        ]);
    }
}
