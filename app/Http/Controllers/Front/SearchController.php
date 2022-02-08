<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SearchController extends Controller
{
    use SEOTools;

    private array $searchable = [
        'page' => Page::class,
    ];

    public function __invoke(Request $request)
    {
        $attributes = $request->validate([
            'query' => ['required', 'string', 'min:3'],
            'type'  => ['string', Rule::in(array_keys($this->searchable))],
        ]);

        $attributes['type'] ??= 'page';

        $attributes['query'] = Str::of($attributes['query'])
            ->stripTags()
            ->explode(' ')
            ->reject(fn (string $term) => Str::length($term) < 3)
            ->join(' ');

        $this->seo()
            ->setTitle(__('app.search.results', ['query' => $attributes['query']]));

        return response()
            ->view('front.search.results', [
                'query' => $attributes['query'],
                'items' => $this->search($attributes['query'], $attributes['type']),
            ])
            ->header('x-robots-tag', 'noindex');
    }

    private function filteredQuery(Request $request, string $key = 'query')
    {
        return Str::of($request->input($key))
            ->explode(' ')
            ->reject(fn (string $term) => Str::length($term) < 3);
    }

    private function search(string $query, string $model): LengthAwarePaginator
    {
        return app($this->searchable[$model])
            ->search($query)
            ->paginate();
    }

    private function searchOld(?string $query): Collection
    {
        $query = Str::of($query)
            ->explode(' ')
            ->reject(fn (string $term) => Str::length($term) < 3)
            ->join(' ');

        $results = collect();

        if ($query) {
            foreach ($this->searchable as $key => $model) {
                $results->push(
                    ...$model::query()
                        ->search($query)
                        ->get()
                );
            }
        }

        return $results;
    }
}
