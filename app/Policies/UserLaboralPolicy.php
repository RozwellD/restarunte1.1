<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserLaboral;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserLaboralPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, UserLaboral $userLaboral)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, UserLaboral $userLaboral)
    {
    }

    public function delete(User $user, UserLaboral $userLaboral)
    {
    }

    public function restore(User $user, UserLaboral $userLaboral)
    {
    }

    public function forceDelete(User $user, UserLaboral $userLaboral)
    {
    }
}
