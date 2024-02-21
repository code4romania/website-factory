<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Language;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LanguagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  User                                  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User                                  $user
     * @param  Language                              $language
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Language $language)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User                                  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User                                  $user
     * @param  Language                              $language
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Language $language)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User                                  $user
     * @param  Language                              $language
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Language $language)
    {
        return $user->isAdmin() && ! $language->isFallback();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User                                  $user
     * @param  Language                              $language
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Language $language)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User                                  $user
     * @param  Language                              $language
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Language $language)
    {
        return $user->isAdmin() && ! $language->isFallback();
    }
}
