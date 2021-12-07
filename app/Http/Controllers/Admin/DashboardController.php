<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Page;
use App\Models\Person;
use App\Models\Post;
use App\Services\Time;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Dashboard', [
            'stats' => $this->stats(),
        ]);
    }

    protected function stats(): array
    {
        return Cache::remember('dashboard-stats', Time::MINUTE_IN_SECONDS, fn () => [
            [
                'type' => 'form',
                'route' => 'admin.forms.index',
                'count' => Form::count(),
            ],
            [
                'type' => 'page',
                'route' => 'admin.pages.index',
                'count' => Page::withDrafted()->count(),
            ],
            [
                'type' => 'person',
                'route' => 'admin.people.index',
                'count' => Person::count(),
            ],
            [
                'type' => 'post',
                'route' => 'admin.posts.index',
                'count' => Post::withDrafted()->count(),
            ],
        ]);
    }
}
