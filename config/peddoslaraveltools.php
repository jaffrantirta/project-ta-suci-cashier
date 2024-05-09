<?php
return [
    'available_permissions' => [
        // item
        [
            'name' => 'item.create',
            'roles' => ['owner', 'cashier']
        ],
        [
            'name' => 'item.update',
            'roles' => ['owner', 'cashier']
        ],
        [
            'name' => 'item.view',
            'roles' => ['owner', 'cashier']
        ],
        [
            'name' => 'item.viewAny',
            'roles' => ['owner', 'cashier']
        ],
        [
            'name' => 'item.delete',
            'roles' => ['owner', 'cashier']
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
        // opname
        [
            'name' => 'opname.create',
            'roles' => ['operation']
        ],
        [
            'name' => 'opname.update',
            'roles' => ['operation']
        ],
        [
            'name' => 'opname.view',
            'roles' => ['operation']
        ],
        [
            'name' => 'opname.viewAny',
            'roles' => ['operation']
        ],
        [
            'name' => 'opname.delete',
            'roles' => ['operation']
        ],
    ],
    'max_login_attempt' => 3,
];
