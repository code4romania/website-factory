<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(function (Request $request, Closure $next) {
            \abort_unless(Setting::sections()->contains($request->section), 404);

            return $next($request);
        })->except('index');
    }

    public function index(): RedirectResponse
    {
        return redirect()->route('admin.settings.edit', Setting::sections()->first());
    }

    public function edit(string $section): Response
    {
        return Inertia::render('Settings/' . Str::studly($section), [
            'section'  => $section,
            'sections' => Setting::sections(),
            'settings' => Setting::section($section),
        ])->model(Setting::class);
    }

    public function store(string $section, SettingRequest $request): RedirectResponse
    {
        $attributes = collect($request->validated()['settings']);

        match ($section) {
            'site'  => $this->storeSiteSection($attributes),
            default => '',
        };

        Cache::tags('settings')->flush();

        return redirect()->route('admin.settings.edit', $section)
            ->with('success', __('setting.event.updated'));
    }

    protected function storeSiteSection(Collection $settings): void
    {
        $settings
            ->filter(fn ($value, $key) => Setting::allowedSettings('site')->has($key))
            ->each(function ($value, $key) {
                if ($key === 'logo') {
                    if (\is_null($value)) {
                        return;
                    }

                    $value = $value->storeAs('assets', 'logo.' . $value->extension(), 'public');
                }

                Setting::set($key, $value, 'site');
            });
    }
}
