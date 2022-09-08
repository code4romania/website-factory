<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        seo()
            ->title(trans_choice('post.label', 2));

        return view('front.posts.index', [
            'posts' => Post::query()
                ->withMedia()
                ->with('categories')
                ->orderByDesc('published_at')
                ->paginate(12),
        ]);
    }

    public function show(string $locale, Post $post): View
    {
        $image = $post->firstMedia('image');

        seo()
            ->title($post->title)
            ->description($post->description)
            ->image($image?->getUrl());

        return view('front.posts.show', [
            'post'  => $post,
            'image' => $image,
        ]);
    }
}
