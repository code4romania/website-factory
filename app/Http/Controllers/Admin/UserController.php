<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Collections\UserCollection;
use App\Http\Resources\UserResource;
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
            'collection' => new UserCollection(
                User::query()
                    ->sort()
                    ->filter()
                    ->paginate(),
            ),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Users/Edit', [
            //
        ])->model(User::class);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $user = User::create($request->validated());

        return redirect()->route('admin.users.show', $user)
            ->with('success', __('user.event.created'));
    }

    public function edit(User $user): Response
    {
        return Inertia::render('Users/Edit', [
            'resource' => UserResource::make($user),
        ])->model(User::class);
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $user->fill($request->validated());

        $user->save();

        return redirect()->route('admin.users.show', $user)
            ->with('success', __('user.event.updated'));
    }
}
