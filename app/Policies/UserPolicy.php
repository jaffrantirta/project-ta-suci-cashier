<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user)
    {
        return $user->can('user.viewAny');
    }

    public function view(User $auth, User $user)
    {
        return $auth->can('user.view');
    }

    public function create(User $user)
    {
        return $user->can('user.create');
    }

    public function update(User $auth, User $user)
    {
        return $auth->can('user.update');
    }

    public function delete(User $auth, User $user)
    {
        return $auth->can('user.delete');
    }
}
