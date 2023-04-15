<?php

return [
    'endpoints' => [
        'site' => [
            'currencies' => '/api/currencies',
            'games' => '/api/games',
            'login' => '/api/users/login',
            'paymentMethods' => '/api/payment-providers',
            'register' => '/api/users/register',
            'reviews' => '/api/reviews',
        ],
        'user' => [
            'changeEmail' => '/api/users/change-email',
            'changePassword' => '/api/users/change-password',
            'changePasswordRequest' => '/api/users/request-new-password',
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
