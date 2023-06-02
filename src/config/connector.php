<?php

return [
    'apiBaseUrl' => env('CMS_API_BASE_URL'),
    'site' => [
        'id' => env('CMS_API_SITE_ID', 1),
        'username' => env('CMS_API_USERNAME', 'username'),
        'password' => env('CMS_API_PASSWORD', 'password'),
    ],
];
