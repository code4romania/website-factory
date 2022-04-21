<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class WelcomeUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function (Request $request, Closure $next) {
            abort_unless(
                $request->hasValidSignature(),
                Response::HTTP_FORBIDDEN,
                __('auth.welcome.invalid_signature')
            );

            abort_unless(
                $request->user,
                Response::HTTP_FORBIDDEN,
                __('auth.welcome.no_user')
            );

            abort_if(
                $request->user->hasSetPassword(),
                Response::HTTP_FORBIDDEN,
                __('auth.welcome.already_used')
            );

            return $next($request);
        });
    }

    public function create(Request $request, User $user): InertiaResponse
    {
        return Inertia::render('Auth/Welcome', [
            'email' => $user->email,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request          $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Welcome!');
    }
}
