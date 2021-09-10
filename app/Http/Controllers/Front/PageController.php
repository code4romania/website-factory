<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        return view('front.page', [
            'page' => Page::query()
                ->with('blocks')
                ->withTranslation()
                ->first(),
        ]);
    }

    public function show(Page $page)
    {
        return $page;
    }
}
