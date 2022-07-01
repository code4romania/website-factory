<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Features;

class ThemeController extends Controller
{
    public function __invoke()
    {
        return response(self::theme())
            ->header('Content-Type', 'text/css');
    }

    protected static function theme(): string
    {
        $colors = Features::hasTheme()
            ? settings('site.colors')
            : ['primary' => '#004890'];

        $colors = collect($colors)
            ->map('color_var')
            ->implode('');

        return <<<CSS
            :root {
                $colors
            }
            CSS;
    }
}
