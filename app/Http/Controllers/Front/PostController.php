<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\View\View;

class PostController extends Controller
{
    use SEOTools;

    public function index(): View
    {
        return view('front.posts.index', [
            'posts' => Post::query()
                ->withMedia()
                ->published()
                ->paginate(12),
        ]);
    }

    public function show(string $locale, Post $post): View
    {
        $image = $post->firstMedia('image');

        $this->seo()
            ->setTitle($post->title)
            ->setDescription($post->description)->addImages(
                optional($image)->getUrl()
            );

        return view('front.posts.show', [
            'post'  => $post,
            'image' => $image,
        ]);
    }
}
