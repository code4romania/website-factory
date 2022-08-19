<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class HelpController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Help/Index', [
            'help' => collect(__('help'))
                ->map(
                    fn (array $chapter) => $this->processChapter($chapter)
                ),
        ]);
    }

    public function show(string $section): Response|RedirectResponse
    {
        $parts = explode('/', $section);

        $contentKey = match (\count($parts)) {
            1       => "${parts[0]}",
            2       => "${parts[0]}.sections.${parts[1]}",
            default => null,
        };

        if (
            \is_null($contentKey) ||
            ! Arr::has(__('help', ), $contentKey)
        ) {
            return redirect()->route('admin.help.index');
        }

        $chapter = __("help.${parts[0]}");

        return Inertia::render('Help/Show', [
            'help' => [
                'asset_url' => asset('assets/images/help'),
                'chapter' => [
                    'key'   => $parts[0],
                    'title' => data_get($chapter, 'title'),
                    'intro' => Str::markdown(data_get($chapter, 'intro', '')),
                ],
                'section' => $this->processSection(
                    section: __("help.$contentKey"),
                    withContent: true
                ),
            ],
        ]);
    }

    protected function processChapter(array $chapter): array
    {
        return [
            'title'    => data_get($chapter, 'title'),
            'intro'    => Str::markdown(data_get($chapter, 'intro', '')),
            'sections' => collect($chapter['sections'])
                ->map(
                    fn ($section) => $this->processSection(
                        section: $section,
                        withContent: false
                    )
                )
                ->all(),
        ];
    }

    protected function processSection(array $section, bool $withContent): array
    {
        $result = [
            'title' => data_get($section, 'title'),
            'intro' => Str::markdown(data_get($section, 'intro', '')),
        ];

        if ($withContent) {
            $result['content'] = Str::markdown(data_get($section, 'content', ''));
            $result['media'] = data_get($section, 'media');
        }

        return $result;
    }
}
