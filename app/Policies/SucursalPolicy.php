<?php

namespace App\Policies;

use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SucursalPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, Sucursal $sucursal)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, Sucursal $sucursal)
    {
    }

    public function delete(User $user, Sucursal $sucursal)
    {
    }

    public function restore(User $user, Sucursal $sucursal)
    {
    }

    public function forceDelete(User $user, Sucursal $sucursal)
    {
    }
}
