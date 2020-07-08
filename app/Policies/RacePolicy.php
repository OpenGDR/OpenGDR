<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Race;
use Illuminate\Auth\Access\HandlesAuthorization;

class RacePolicy
{
    use HandlesAuthorization;


    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Race  $race
     * @return mixed
     */
    public function view(User $user, Race $race)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Race  $race
     * @return mixed
     */
    public function update(User $user, Race $race)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Race  $race
     * @return mixed
     */
    public function delete(User $user, Race $race)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Race  $race
     * @return mixed
     */
    public function restore(User $user, Race $race)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Race  $race
     * @return mixed
     */
    public function forceDelete(User $user, Race $race)
    {
        //
    }
}
