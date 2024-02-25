<?php

namespace App\Policies;

use App\Models\TransactionDetail;
use App\Models\User;

class TransactionDetailPolicy
{
    public function viewAny(User $user)
    {
        return $user->can('transactiondetail.viewAny');
    }

    public function view(User $user, TransactionDetail $transactiondetail)
    {
        return $user->can('transactiondetail.view');
    }

    public function create(User $user)
    {
        return $user->can('transactiondetail.create');
    }

    public function update(User $user, TransactionDetail $transactiondetail)
    {
        return $user->can('transactiondetail.update');
    }

    public function delete(User $user, TransactionDetail $transactiondetail)
    {
        return $user->can('transactiondetail.delete');
    }
}
