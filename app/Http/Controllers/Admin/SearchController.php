<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    private array $searchable = [
        Page::class,
    ];

    public function __invoke(Request $request)
    {
        $attributes = $request->validate([
            'query' => ['required', 'string', 'min:3'],
        ]);

        $query = Str::of($attributes['query'])
            ->stripTags()
            ->explode(' ')
            ->reject(fn (string $term) => Str::length($term) < 3);

        $results = collect();

        if ($query->isNotEmpty()) {
            $query = $query
                // ->map(fn (string $term) => "+{$term}*")
                ->join(' ');

            foreach ($this->searchable as $model) {
                $results->push(
                    ...$model::query()
                        ->search($query, multilingual: true)
                        ->get()
                        ->pluck('search_result')
                );
            }
        }

        return response()->json($results);
    }
}
