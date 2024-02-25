<?php

namespace App\Policies;

use App\Models\Item;
use App\Models\User;

class ItemPolicy
{
    public function viewAny(User $user)
    {
        return $user->can('item.viewAny');
    }

    public function view(User $user, Item $item)
    {
        return $user->can('item.view');
    }

    public function create(User $user)
    {
        return $user->can('item.create');
    }

    public function update(User $user, Item $item)
    {
        return $user->can('item.update');
    }

    public function delete(User $user, Item $item)
    {
        return $user->can('item.delete');
    }
}
