<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Collections\UserCollection;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(User::class);
    }

    public function index(): Response
    {
        return Inertia::render('Users/Index', [
            'users' => new UserCollection(
                User::query()
                    ->sort()
                    ->filter()
                    ->paginate(),
            ),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Users/Create', [
            //
        ]);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $user = User::create($request->validated());

        return redirect()->route('admin.users.show', $user)
            ->with('success', __('user.event.created'));
    }

    public function show(User $user): Response
    {
        return Inertia::render('Users/Show', [
            //
        ]);
    }

    public function edit(User $user): Response
    {
        return Inertia::render('Users/Edit', [
            //
        ]);
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $user->fill($request->validated());

        $user->save();

        return redirect()->route('admin.users.show', $user)
            ->with('success', __('user.event.updated'));
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.users.show', $user)
            ->with('success', __('user.event.deleted'));
    }
}
