<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Form;

class FormController extends Controller
{
    public function show(string $locale, Form $form)
    {
        return $form;
    }
}
