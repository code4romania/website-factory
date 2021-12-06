<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FormController extends Controller
{
    use SEOTools;

    public function show(string $locale, Form $form): View
    {
        $this->seo()
            ->setTitle($form->title);

        return view('front.forms.show', [
            'form' => $form,
        ]);
    }

    public function submit(string $locale, Request $request, Form $form)
    {
        dd($request->all());
    }
}
