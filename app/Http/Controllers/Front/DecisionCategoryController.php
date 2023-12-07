<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\DecisionCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DecisionCategoryController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('front.decisions.index');
    }

    public function show(string $locale, DecisionCategory $decisionCategory): View
    {
        seo()
            ->title((string) $decisionCategory->title)
            ->description((string) $decisionCategory->description);

        return view('front.decisions.category', [
            'category' => $decisionCategory,
            'decisions' => $decisionCategory
                ->decisions()
                ->latest('published_at')
                ->paginate(12),
        ]);
    }
}
