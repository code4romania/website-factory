<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\DecisionCategory;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DecisionCategoryController extends Controller
{
    use SEOTools;

    public function index(): RedirectResponse
    {
        return redirect()->route('front.decisions.index');
    }

    public function show(string $locale, DecisionCategory $decisionCategory): View
    {
        $this->seo()
            ->setTitle($decisionCategory->title)
            ->setDescription($decisionCategory->description);

        return view('front.decisions.category', [
            'category' => $decisionCategory,
            'decisions'    => $decisionCategory
                ->decisions()
                ->with('categories')
                ->paginate(12),
        ]);
    }
}
