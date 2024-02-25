<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;

class TransactionPolicy
{
    public function viewAny(User $user)
    {
        return $user->can('transaction.viewAny');
    }

    public function view(User $user, Transaction $transaction)
    {
        return $user->can('transaction.view');
    }

    public function create(User $user)
    {
        return $user->can('transaction.create');
    }

    public function update(User $user, Transaction $transaction)
    {
        return $user->can('transaction.update');
    }

    public function delete(User $user, Transaction $transaction)
    {
        return $user->can('transaction.delete');
    }
}
