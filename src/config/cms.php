<?php

return [
    'endpoints' => [
        'site' => [
            'changePassword' => '/api/users/change-password',
            'confirmEmail' => '/api/users/confirm-email',
            'currencies' => '/api/currencies',
            'games' => '/api/games',
            'login' => '/api/users/login',
            'paymentMethods' => '/api/payment-providers-payment-methods',
            'register' => '/api/users/register',
            'requestNewPassword' => '/api/users/request-new-password',
            'reviews' => '/api/reviews',
            'sendEmailConfirmationMail' => '/api/users/send-email-confirmation-mail',
        ],
        'user' => [
            'logout' => '/api/users/logout',
            'orders' => [
                'create' => '/api/users/orders',
                'history' => '/api/users/orders',
                'productHistory' => '/api/users/orders/products',
                'orderNumber' => '/api/users/orders/order-number/',
            ],
            'reviews' => [
                'create' => '/api/reviews'
            ],
            'updateProfile' => '/api/users/preferences',
        ]
    ]
];
