<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

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
            ->map('color_var')
            ->implode('');

        return <<<CSS
            :root {
                $colors
            }
            CSS;
    }
}
