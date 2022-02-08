<?php

declare(strict_types=1);

namespace App\View\Components\Site;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class SearchForm extends Component
{
    public string $action;

    public ?string $query = null;

    public function __construct(Request $request)
    {
        $this->action = localized_route('front.search');

        $this->query = $request->query('query');
    }

    public function render(): View
    {
        return view('components.site.search-form');
    }
}
