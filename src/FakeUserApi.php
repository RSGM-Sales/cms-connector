<?php

namespace RSGMSales\Connector;

use RSGMSales\Connector\Contracts\UserApiInterface;
use RSGMSales\Connector\Dto\CreateOrderData;
use RSGMSales\Connector\Dto\CreateReviewData;
use RSGMSales\Connector\Dto\UserPreferencesData;
use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\LoginApiResponse;

class FakeUserApi implements UserApiInterface
{
    public function createReview(mixed $data): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function createOrder(mixed $data): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function getOrderHistory(int $page = 0): BaseApiResponse
    {
        $data = [];

        for ($i = 0; $i < 6; $i++) {
            $data[] = (object)[
                'id' => $i,
                'type' => 'order',
                'attributes' => [
                    'orderNumber' => fake()->uuid(),
                    'status' => 'INITIATED',
                    'createdAt' => fake()->date(),
                ],
                'relationships' => (object)[
                    'product' => (object)[
                        'id' => fake()->randomNumber(),
                        'type' => 'product',
                        'attributes' => (object)[
                            'name' => fake()->text(10),
                            'slug' => fake()->slug(),
                            'pricePerUnit' => fake()->randomFloat(2,1,10),
                        ],
                    ],
                    'order' => (object)[
                        'coupon' => (object)[
                            'id' => fake()->randomNumber(),
                            'type' => 'coupon',
                            'attributes' => (object)[
                                'code' => fake()->text(5),
                            ],
                        ],
                        'currency' => (object)[
                            'type' => 'currency',
                            'id' => fake()->randomNumber(),
                            'attributes' => (object)[
                                'name' => fake()->currencyCode(),
                                'code' => fake()->currencyCode(),
                                'symbol' => Currencies::getSymbol(fake()->currencyCode()),
                                'rate' => fake()->randomFloat(5,0,2),
                            ],
                        ],
                        'orderProducts' => [],
                        'paymentProviderPaymentMethod' => (object)[
                            'type' => 'paymentProviderPaymentMethod',
                            'id' => fake()->randomNumber(),
                            'attributes' => (object)[
                                'fee' => fake()->randomFloat(2,0,50),
                            ],
                            'relationships' => (object)[
                                'paymentMethod' => (object)[
                                    'type' => 'paymentMethod',
                                    'id' => fake()->randomNumber(),
                                    'attributes' => (object)[
                                        'name' => fake()->name(),
                                    ],
                                ],
                                'paymentProvider' => (object)[
                                    'type' => 'paymentProvider',
                                    'id' => fake()->randomNumber(),
                                    'attributes' => (object)[
                                        'name' => fake()->name(),
                                    ],
                                ],
                            ],
                        ],
                        'payment' => (object)[
                            'id' => fake()->randomNumber(),
                            'type' => 'payment',
                            'attributes' => (object)[
                                'status' => 'INITIATED',
                                'price' => fake()->randomFloat(2,0,50),
                            ],
                        ],
                        'user' => null,
                    ]
                ]
            ];
        }

        return new BaseApiResponse(200, "", (object)[
            'data' => $data
        ]);
    }

    public function getOrderProductHistory(int $page = 0): BaseApiResponse
    {
        $data = [];

        for ($i = 0; $i < 6; $i++) {
            $data[] = (object)[
                'id' => $i,
                'type' => 'orderProduct',
                'attributes' => (object)[
                    'amount' => fake()->randomFloat(2, 1, 10),
                ],
                'relationships' => (object)[
                    'product' => (object)[
                        'id' => fake()->randomNumber(),
                        'type' => 'product',
                        'attributes' => (object)[
                            'name' => fake()->text(10),
                            'slug' => fake()->slug(),
                            'pricePerUnit' => fake()->randomFloat(2,1,10),
                        ],
                    ],
                    'order' => (object)[
                        'coupon' => (object)[
                            'id' => fake()->randomNumber(),
                            'type' => 'coupon',
                            'attributes' => (object)[
                                'code' => fake()->text(5),
                            ],
                        ],
                        'currency' => (object)[
                            'type' => 'currency',
                            'id' => fake()->randomNumber(),
                            'attributes' => (object)[
                                'name' => fake()->currencyCode(),
                                'code' => fake()->currencyCode(),
                                'symbol' => Currencies::getSymbol(fake()->currencyCode()),
                                'rate' => fake()->randomFloat(5,0,2),
                            ],
                        ],
                        'orderProducts' => [],
                        'paymentProviderPaymentMethod' => (object)[
                            'type' => 'paymentProviderPaymentMethod',
                            'id' => fake()->randomNumber(),
                            'attributes' => (object)[
                                'fee' => fake()->randomFloat(2,0,50),
                            ],
                            'relationships' => (object)[
                                'paymentMethod' => (object)[
                                    'type' => 'paymentMethod',
                                    'id' => fake()->randomNumber(),
                                    'attributes' => (object)[
                                        'name' => fake()->name(),
                                    ],
                                ],
                                'paymentProvider' => (object)[
                                    'type' => 'paymentProvider',
                                    'id' => fake()->randomNumber(),
                                    'attributes' => (object)[
                                        'name' => fake()->name(),
                                    ],
                                ],
                            ],
                        ],
                        'payment' => (object)[
                            'id' => fake()->randomNumber(),
                            'type' => 'payment',
                            'attributes' => (object)[
                                'status' => 'INITIATED',
                                'price' => fake()->randomFloat(2,0,50),
                            ],
                        ],
                        'user' => null,
                    ]
                ]
            ];
        }
    }

    public function logout(): BaseApiResponse
    {
        session(['user-api-token' => null]);
        return new BaseApiResponse();
    }

    public function updateProfile(mixed $data): LoginApiResponse
    {
        $token = fake()->uuid();
        session(['user-api-token' => $token]);

        return new LoginApiResponse(200, '', (object)[
            "data" => (object) [
                "type" => "user",
                "attributes" => (object) [
                    "email" => $profileData->email ?? fake()->email(),
                    "token" => $token,
                    "firstName" => fake()->firstName(),
                    "lastName" => fake()->lastName(),
                    "marketingOptIn" => $profileData->marketingOptIn ?? fake()->boolean()
                ]
            ]
        ]);
    }
}
