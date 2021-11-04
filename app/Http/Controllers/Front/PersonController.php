<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Person;

class PersonController extends Controller
{
    public function index()
    {
        return Person::all();
    }

    public function show(string $locale, Person $person)
    {
        return $person;
    }
}
