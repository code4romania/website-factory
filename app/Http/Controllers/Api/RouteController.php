<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Tightenco\Ziggy\Ziggy;

class RouteController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(new Ziggy);
    }
}
