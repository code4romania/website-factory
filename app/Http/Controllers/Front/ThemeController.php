<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class ThemeController extends Controller
{
    public function __invoke()
    {
        return response(self::theme())
            ->header('Content-Type', 'text/css');
    }

    protected static function theme(): string
    {
        $colors = collect(settings('site.colors'))
            ->map(function (string $hex, string $name) {
                $hex = ltrim($hex, '#');

                $rgb = match (Str::length($hex)) {
                    3       => str_split($hex, 1),
                    6       => str_split($hex, 2),
                    default => [0, 0, 0]
                };

                $rgb = collect($rgb)
                    ->map(fn (string $c) => hexdec(str_pad($c, 2, $c)))
                    ->implode(',');

                return "--color-${name}:${rgb};";
            })
            ->implode('');

        return <<<CSS
            :root {
                $colors
            }
            CSS;
    }
}
