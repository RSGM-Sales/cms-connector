<?php

return [
    'endpoints' => [
        'site' => [
            'changePassword' => '/api/users/change-password',
            'currencies' => '/api/currencies',
            'games' => '/api/games',
            'login' => '/api/users/login',
            'paymentMethods' => '/api/payment-providers',
            'register' => '/api/users/register',
            'requestNewPassword' => '/api/users/request-new-passwordt',
            'reviews' => '/api/reviews',
        ],
        'user' => [
            'feedback' => [
                'create' => '/api/feedback'
            ],
            'orders' => [
                'create' => '/api/orders',
                'history' => '/api/users/orders'
            ],
            'updateProfile' => '/api/users/profile',
        ]
    ]
];
