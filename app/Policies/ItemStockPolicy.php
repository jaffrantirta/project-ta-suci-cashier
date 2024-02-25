<?php

namespace App\Policies;

use App\Models\ItemStock;
use App\Models\User;

class ItemStockPolicy
{
    public function viewAny(User $user)
    {
        return $user->can('itemstock.viewAny');
    }

    public function view(User $user, ItemStock $itemstock)
    {
        return $user->can('itemstock.view');
    }

    public function create(User $user)
    {
        return $user->can('itemstock.create');
    }

    public function update(User $user, ItemStock $itemstock)
    {
        return $user->can('itemstock.update');
    }

    public function delete(User $user, ItemStock $itemstock)
    {
        return $user->can('itemstock.delete');
    }
}
