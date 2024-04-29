<?php
return [
    'available_permissions' => [
        // item
        [
            'name' => 'item.create',
            'roles' => ['owner']
        ],
        [
            'name' => 'item.update',
            'roles' => ['owner', 'operation']
        ],
        [
            'name' => 'item.view',
            'roles' => ['owner', 'operation', 'cashier']
        ],
        [
            'name' => 'item.viewAny',
            'roles' => ['owner', 'operation', 'cashier']
        ],
        [
            'name' => 'item.delete',
            'roles' => ['owner']
        ],
        // user
        [
            'name' => 'user.create',
            'roles' => ['owner']
        ],
        [
            'name' => 'user.update',
            'roles' => ['owner']
        ],
        [
            'name' => 'user.view',
            'roles' => ['owner']
        ],
        [
            'name' => 'user.viewAny',
            'roles' => ['owner']
        ],
        [
            'name' => 'user.delete',
            'roles' => ['owner']
        ],
        // stock
        [
            'name' => 'stock.create',
            'roles' => ['owner', 'operation']
        ],
        [
            'name' => 'stock.update',
            'roles' => ['owner', 'operation']
        ],
        [
            'name' => 'stock.view',
            'roles' => ['owner', 'operation', 'cashier']
        ],
        [
            'name' => 'stock.viewAny',
            'roles' => ['owner', 'operation', 'cashier']
        ],
        [
            'name' => 'stock.delete',
            'roles' => ['owner']
        ],
        // transaction
        [
            'name' => 'transaction.create',
            'roles' => ['owner', 'cashier']
        ],
        [
            'name' => 'transaction.update',
            'roles' => ['owner']
        ],
        [
            'name' => 'transaction.view',
            'roles' => ['owner', 'operation', 'cashier']
        ],
        [
            'name' => 'transaction.viewAny',
            'roles' => ['owner', 'operation', 'cashier']
        ],
        [
            'name' => 'transaction.delete',
            'roles' => ['owner']
        ],
        // transaction detail
        [
            'name' => 'transactiondetail.create',
            'roles' => ['owner', 'cashier']
        ],
        [
            'name' => 'transactiondetail.update',
            'roles' => ['owner']
        ],
        [
            'name' => 'transactiondetail.view',
            'roles' => ['owner', 'operation', 'cashier']
        ],
        [
            'name' => 'transactiondetail.viewAny',
            'roles' => ['owner', 'operation', 'cashier']
        ],
        [
            'name' => 'transactiondetail.delete',
            'roles' => ['owner']
        ],
    ],
    'max_login_attempt' => 3,
];
