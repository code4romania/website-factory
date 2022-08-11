<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Inertia\Response;

class HelpController extends AdminController
{
    public function index(): Response
    {
        return Inertia::render('Help/Index', [
            //
        ]);
    }

    public function section(string $section): Response
    {
        return Inertia::render('Help/Section', [
            'section' => $section,
        ]);
    }
}
