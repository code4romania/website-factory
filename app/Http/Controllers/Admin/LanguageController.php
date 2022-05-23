<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LanguageRequest;
use App\Http\Resources\Collections\LanguageCollection;
use App\Http\Resources\LanguageResource;
use App\Models\Language;
use App\Models\LanguageLine;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class LanguageController extends Controller
{
    public function lines(?string $locale = null): JsonResponse
    {
        $locale = locales()->has($locale) ? $locale : config('app.fallback_locale');

        return response()->json(
            LanguageLine::getTranslationsForGroup($locale, '*')
        );
    }

    public function index(): Response
    {
        return Inertia::render('Languages/Index', [
            'collection' => new LanguageCollection(
                Language::query()
                    ->paginate()
            ),
        ]);

        return redirect()->route('admin.settings.edit', Setting::sections()->first());
    }

    public function create(): Response
    {
        return Inertia::render('Languages/Edit', [
            'source' => LanguageLine::getTranslationsForGroup(config('app.fallback_locale'), '*'),
        ])->model(Language::class);
    }

    public function store(LanguageRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $language = Language::create($attributes);

        return redirect()->route('admin.languages.edit', $language)
            ->with('success', __('language.event.created'));
    }

    public function edit(Language $language): Response
    {
        return Inertia::render('Languages/Edit', [
            'resource' => LanguageResource::make($language),
            'source'   => LanguageLine::getTranslationsForGroup(config('app.fallback_locale'), '*'),
        ])->model(Language::class);
    }

    public function update(LanguageRequest $request, Language $language): RedirectResponse
    {
        $attributes = $request->validated();

        $language->update($attributes);

        return redirect()->route('admin.languages.edit', $language)
            ->with('success', __('language.event.updated'));
    }

    public function destroy(string $code): RedirectResponse
    {
        Language::query()
            ->where('code', $code)
            ->delete();

        return redirect()->route('admin.languages.index')
            ->with('success', __('language.event.deleted'));
    }
}
