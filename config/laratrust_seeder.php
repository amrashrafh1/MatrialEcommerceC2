<?php

return [
    'role_structure' => [
        'superadministrator' => [
           'users'              => 'c,r,u,d',
           'profile'            => 'r,u',
           'categories'         => 'c,r,u,d',
           'tradmarks'          => 'c,r,u,d',
           'malls'              => 'c,r,u,d',
           'countries'          => 'c,r,u,d',
           'cities'             => 'c,r,u,d',
           'shippingCompanies'  => 'c,r,u,d',
           'manufacturers'      => 'c,r,u,d',
           'settings'           => 'c,r,u,d',
           'posts'              => 'c,r,u,d',
           'adzs'               => 'c,r,u,d',
           'sliders'            => 'c,r,u,d',
           'contact_us'         => 'c,r,u,d',
           'ourworks'           => 'c,r,u,d',
           'cmss'               => 'c,r,u,d',
           'products'           => 'c,r,u,d',
           'discounts'          => 'c,r,u,d',
           'orders'             => 'c,r,u,d',
           'methods'            => 'c,r,u,d',
           'zones'              => 'c,r,u,d',
           'attribute_families' => 'c,r,u,d',
           'payments'           => 'c,r,u,d',
           'sellers'            => 'c,r,u,d',
           'sellers-app'        => 'c,r',
           'stores'             => 'c,r,u,d',
           'activities'         => 'c,r,u,d',

        ],
        'administrator' => ['profile' => 'r,u'],
        'user' => [
            'profile' => 'r,u'
        ],
        'seller' => [
            'profile'   => 'r,u',
            'products'  => 'c,r,u,d',
            'disocunts' => 'c,r,u,d',
            'orders'    => 'r',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];

