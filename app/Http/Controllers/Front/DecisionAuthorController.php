<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\DecisionAuthor;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DecisionAuthorController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('front.decisions.index');
    }

    public function show(string $locale, DecisionAuthor $decisionAuthor): View
    {
        seo()
            ->title($decisionAuthor->title)
            ->description($decisionAuthor->description);

        return view('front.decisions.category', [
            'category' => $decisionAuthor,
            'decisions' => $decisionAuthor
                ->decisions()
                ->latest('published_at')
                ->paginate(12),
        ]);
    }
}
