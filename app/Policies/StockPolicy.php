<?php

namespace App\Policies;

use App\Models\Stock;
use App\Models\User;

class StockPolicy
{
    public function viewAny(User $user)
    {
        return $user->can('stock.viewAny');
    }

    public function view(User $user, Stock $stock)
    {
        return $user->can('stock.view');
    }

    public function create(User $user)
    {
        return $user->can('stock.create');
    }

    public function update(User $user, Stock $stock)
    {
        return $user->can('stock.update');
    }

    public function delete(User $user, Stock $stock)
    {
        return $user->can('stock.delete');
    }
}
