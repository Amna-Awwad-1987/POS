<?php

return [
    'role_structure' => [
        'super_admin' => [
            'users' => 'c,r,e,d',
            'categories' => 'c,r,e,d',
            'products' => 'c,r,e,d',
            'clients' => 'c,r,e,d',
            'orders' => 'c,r,e,d',

        ],
        'admin' => [],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'e' => 'edit',
        'd' => 'delete',
    ]
];
