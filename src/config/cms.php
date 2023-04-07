<?php

return [
    'endpoints' => [
        'site' => [
            'currencies' => '/api/currencies',
            'games' => '/api/games',
            'login' => '/api/users/login',
            'paymentMethods' => '/api/payment-methods',
            'register' => '/api/users/register',
            'reviews' => '/api/reviews',
        ],
        'user' => [
            'changeEmail' => '/api/users/change-email',
            'changePassword' => '/api/users/change-password',
            'orders' => [
                'create' => '/api/orders',
                'history' => '/api/users/orders'
            ],
            'updateProfile' => '/api/users/profile',
        ]
    ]
];
