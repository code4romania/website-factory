<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Help;
use Illuminate\Http\JsonResponse;

class HelpController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(
            Help::all()
        );
    }
}
