<?php

namespace App\Policies;

use App\Models\ItemUnit;
use App\Models\User;

class ItemUnitPolicy
{
    public function viewAny(User $user)
    {
        return $user->can('itemunit.viewAny');
    }

    public function view(User $user, ItemUnit $itemunit)
    {
        return $user->can('itemunit.view');
    }

    public function create(User $user)
    {
        return $user->can('itemunit.create');
    }

    public function update(User $user, ItemUnit $itemunit)
    {
        return $user->can('itemunit.update');
    }

    public function delete(User $user, ItemUnit $itemunit)
    {
        return $user->can('itemunit.delete');
    }
}
