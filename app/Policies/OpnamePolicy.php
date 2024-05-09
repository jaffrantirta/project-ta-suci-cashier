<?php

namespace App\Policies;

use App\Models\Opname;
use App\Models\User;

class OpnamePolicy
{
    public function viewAny(User $user)
    {
        return $user->can('opname.viewAny');
    }

    public function view(User $user, Opname $opname)
    {
        return $user->can('opname.view');
    }

    public function create(User $user)
    {
        return $user->can('opname.create');
    }

    public function update(User $user, Opname $opname)
    {
        return $user->can('opname.update');
    }

    public function delete(User $user, Opname $opname)
    {
        return $user->can('opname.delete');
    }
}
