<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Decision;
use Illuminate\View\View;

class DecisionController extends Controller
{
    public function index(): View
    {
        seo()
            ->title(trans_choice('decision.label', 2));

        return view('front.decisions.index', [
            'decisions' => Decision::query()
                ->with('categories')
                ->latest('published_at')
                ->paginate(),
        ]);
    }

    public function show(string $locale, Decision $decision): View
    {
        seo()
            ->title((string) $decision->title)
            ->description((string) $decision->description);

        return view('front.decisions.show', [
            'decision' => $decision,
        ]);
    }
}
