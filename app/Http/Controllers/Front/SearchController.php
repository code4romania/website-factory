<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\SearchRequest;
use App\Services\Features;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    use SEOTools;

    public function __invoke(SearchRequest $request)
    {
        $attributes = $request->validated();

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
                'type'  => $attributes['type'],
                'types' => $this->getAvailableTypes(),
                'items' => $this->search($attributes['query'], $attributes['type']),
            ])
            ->header('x-robots-tag', 'noindex');
    }

    protected function getAvailableTypes(): Collection
    {
        $types = collect(config('search.models'))
            ->mapWithKeys(fn (string $model) => [
                app($model)->getMorphClass() => $model,
            ]);

        if (! Features::hasDecisions()) {
            $types->forget('decision');
        }

        return $types->keys();
    }

    protected function search(string $query, string $model): LengthAwarePaginator
    {
        $model = collect(config('search.models'))
            ->firstWhere(fn (string $class) => $model === app($class)->getMorphClass());

        return $model::query()
            ->search($query)
            ->paginate(
                perPage: 20
            );
    }
}
