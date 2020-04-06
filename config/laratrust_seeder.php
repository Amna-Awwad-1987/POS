<?php

return [
    'role_structure' => [
        'super_admin' => [
            'users' => 'c,r,e,d',
        ],
        'admin' => [],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'e' => 'edit',
        'd' => 'delete'
    ]
];
