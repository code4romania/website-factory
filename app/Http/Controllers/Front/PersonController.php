<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Contracts\View\View;

class PersonController extends Controller
{
    use SEOTools;

    public function show(string $locale, Person $person): View
    {
        $image = $person->firstMedia('image');

        $this->seo()
            ->setTitle($person->name)
            ->setDescription($person->description)
            ->addImages(
                optional($image)->getUrl()
            );

        return view('front.people.show', [
            'person' => $person,
            'image'  => $image,
        ]);
    }
}
