<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HealthCheckController extends Controller
{
    public function __invoke(Request $request): Response
    {
        return response('ok');
    }
}
