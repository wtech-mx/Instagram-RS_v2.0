<?php

namespace App\Policies;

use App\Profile;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Profile $profile)
    {
        //
         return $user->id === $profile->user_id;
    }

    public function update(User $user, Profile $profile)
    {
        return $user->id === $profile->user_id;
    }
}
