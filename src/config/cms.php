<?php

return [
    'endpoints' => [
        'site' => [
            'changePassword' => '/api/users/change-password',
            'currencies' => '/api/currencies',
            'games' => '/api/games',
            'login' => '/api/users/login',
            'paymentMethods' => '/api/payment-providers-payment-methods',
            'register' => '/api/users/register',
            'requestNewPassword' => '/api/users/request-new-password',
            'reviews' => '/api/reviews',
        ],
        'user' => [
            'logout' => '/api/users/logout',
            'orders' => [
                'create' => '/api/orders',
                'history' => '/api/users/orders'
            ],
            'reviews' => [
                'create' => '/api/reviews'
            ],
            'updateProfile' => '/api/users/preferences',
        ]
    ]
];
