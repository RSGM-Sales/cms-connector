<?php

return [
    'base_url' => 'https://google.com/api',
    'endpoints' => [
        'site' => [
            'currencies' => '/currencies',
            'login' => '/users/login',
            'paymentMethods' => '/payment-methods',
            'reviews' => '/reviews',
        ],
        'user' => [
            'changeEmail' => '/users/change-email',
            'changePassword' => '/users/change-password',
            'orders' => [
                'create' => '/orders',
                'history' => '/users/orders'
            ],
            'updateProfile' => '/users/profile',
        ]
    ]
];
