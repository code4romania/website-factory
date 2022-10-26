<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\DecisionAuthor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DecisionAuthorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User                      $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User                      $user
     * @param  \App\Models\DecisionAuthor            $decisionAuthor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, DecisionAuthor $decisionAuthor)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User                      $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User                      $user
     * @param  \App\Models\DecisionAuthor            $decisionAuthor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, DecisionAuthor $decisionAuthor)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User                      $user
     * @param  \App\Models\DecisionAuthor            $decisionAuthor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, DecisionAuthor $decisionAuthor)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User                      $user
     * @param  \App\Models\DecisionAuthor            $decisionAuthor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, DecisionAuthor $decisionAuthor)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User                      $user
     * @param  \App\Models\DecisionAuthor            $decisionAuthor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, DecisionAuthor $decisionAuthor)
    {
        return $user->isAdmin();
    }
}
