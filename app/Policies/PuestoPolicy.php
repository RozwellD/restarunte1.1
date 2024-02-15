<?php

namespace App\Policies;

use App\Models\Puesto;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PuestoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, Puesto $puesto)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, Puesto $puesto)
    {
    }

    public function delete(User $user, Puesto $puesto)
    {
    }

    public function restore(User $user, Puesto $puesto)
    {
    }

    public function forceDelete(User $user, Puesto $puesto)
    {
    }
}
