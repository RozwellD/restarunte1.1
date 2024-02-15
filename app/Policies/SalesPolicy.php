<?php

namespace App\Policies;

use App\Models\Sales;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalesPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;

    }

    public function view(User $user, Sales $sales): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Sales $sales): bool
    {
        return true;
    }

    public function delete(User $user, Sales $sales): bool
    {
        return true;
    }

    public function restore(User $user, Sales $sales): bool
    {
        return true;
    }

    public function forceDelete(User $user, Sales $sales): bool
    {
        return true;
    }
}
