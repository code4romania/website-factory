<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User                      $loggedInUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $loggedInUser)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User                      $loggedInUser
     * @param  \App\Models\User                      $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $loggedInUser, User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User                      $loggedInUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $loggedInUser)
    {
        return $loggedInUser->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User                      $loggedInUser
     * @param  \App\Models\User                      $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $loggedInUser, User $user)
    {
        return $loggedInUser->isAdmin() || $loggedInUser->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User                      $loggedInUser
     * @param  \App\Models\User                      $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $loggedInUser, User $user)
    {
        return $loggedInUser->isAdmin() && ! $loggedInUser->is($user);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User                      $loggedInUser
     * @param  \App\Models\User                      $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $loggedInUser, User $user)
    {
        return $loggedInUser->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User                      $loggedInUser
     * @param  \App\Models\User                      $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $loggedInUser, User $user)
    {
        return $loggedInUser->isAdmin();
    }
}
