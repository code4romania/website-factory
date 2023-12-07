<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Contracts\View\View;

class PersonController extends Controller
{
    public function show(string $locale, Person $person): View
    {
        $image = $person->firstMedia('image');

        seo()
            ->title((string) $person->name)
            ->description((string) $person->description)
            ->image((string) $image?->getUrl());

        return view('front.people.show', [
            'person' => $person,
            'image' => $image,
        ]);
    }
}
