<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $attributes = collect($request->validated()['settings'])
            ->filter(fn ($value, $key) => Setting::allowedSettings($section)->has($key));

        $settings = match ($section) {
            'site' => $attributes->map(
                fn ($value, $key) => match ($key) {
                    default => $value,
                    'logo'  => $value?->storePubliclyAs('assets', 'logo.' . $value?->extension()),
                }
            ),
            'donations' => $attributes->map(
                fn ($value, $key) => match ($key) {
                    default                => $value,
                    'mobilpay_enabled'     => \boolval($value),
                    'mobilpay_certificate' => $value?->storeAs('private/donations', $value?->getClientOriginalName()),
                    'mobilpay_private_key' => $value?->storeAs('private/donations', $value?->getClientOriginalName()),
                }
            ),
            default => null,
        };

        $settings = collect($settings)
            ->reject(fn ($value) => \is_null($value))
            ->each(
                fn ($value, $key) => Setting::updateOrCreate(
                    [
                        'key'     => $key,
                        'section' => $section,
                    ],
                    [
                        'value' => $value,
                    ]
                )
            );

        return redirect()->route('admin.settings.edit', $section)
            ->with('success', __('setting.event.updated'));
    }
}
