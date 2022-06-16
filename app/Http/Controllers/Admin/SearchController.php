<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function __invoke(Request $request): JsonResponse
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
            $query = $query->join(' ');

            foreach (config('search.models') as $model) {
                $results->push(
                    ...$model::query()
                        ->search($query, searchAllLanguages: true)
                        ->take(25)
                        ->get()
                        ->pluck('search_result')
                );
            }
        }

        return response()->json($results);
    }
}
