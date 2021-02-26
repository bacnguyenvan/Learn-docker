<?php

return [
    'notification' => [
        'limit' => 10
    ],
    'montbell' => [
        'base_url' => 'https://api.montbell.jp/app',
        'appli_key' => env('MONTBELL_APPLI_KEY', 'riS0NsSQZi8b7zniROPPUF'),
        'blowfish_key' => env('MONTBELL_BLOWFISH_KEY', 'XE78wk473MoBl'),
        'access_token_ttl' => env('MONTBELL_ACCESS_TOKEN_TTL', 1100), // 1100 seconds
        'device_type' => env('MONTBELL_DEVICE_TYPE', 1),
        'device_version' => env('MONTBELL_DEVICE_VERSION', 8),
        'device_kishu_code' => env('MONTBELL_DEVICE_KISHU_CODE', 'iphone-8'),
        'app_version' => env('MONTBELL_APP_VERSION', '1'),
        'encrypt_code' => env('ENCRYPT_CODE', 'BF-ECB'),
        'app_id' => env('MONTBELL_APP_ID', 2),
        'response_status_code' => [
            100 => 'There is no key.',
            101 => 'The key is not alphanumeric.',
            102 => 'There is no OS type for the terminal.',
            103 => 'There is no OS version of the terminal.',
            104 => 'There is no terminal model identification code.',
            105 => 'There is no app version number.',
            106 => 'Please set with a numerical value.',
            107 => 'Set with a floating point value.',
            108 => 'Set the OS type of the terminal correctly.',
            109 => 'There is no access token.',
            110 => 'There is no device token.',
            111 => 'There is no update date and time when it was last acquired.',
            112 => 'The store number cannot be blank.',
            113 => 'A login error has occurred in the input item.',
            114 => 'Please set the login ID with 6 characters or more.',
            115 => 'Please set the login ID with 64 characters or less.',
            116 => 'The login ID contains characters that cannot be used.',
            117 => 'Please set the password with 8 characters or more.',
            118 => 'Please set the password with 64 characters or less.',
            119 => 'For the password, set a character string different from the ID.',
            120 => 'The password contains characters that cannot be used.',
            121 => 'You cannot set the \ symbol in the password.',
            122 => 'You cannot set spaces at the beginning and end of the password.',
            123 => 'Please set the password in a mixture of half-width alphabetic characters, half-width numbers, and half-width symbols.',
            124 => 'The app version number is invalid.',
            125 => 'App key mismatch',
            200 => 'The access token is invalid.',
            201 => 'Access token timeout',
            // 300 => 'The login token is invalid.',
            300 => 'The data could not be obtained. Please log in again.',
            350 => 'The login ID or password is incorrect.',
            400 => 'Device token registration error',
            401 => 'User information acquisition error',
            402 => 'Prefectural list acquisition error',
            403 => 'Area list acquisition error',
            404 => 'Activity list acquisition error',
            405 => 'Shop list acquisition error',
            406 => 'Store attribute list acquisition error',
            407 => 'An error occurred during logout.',
            408 => 'An error occurred during login.',
            409 => 'Login error in status',
            410 => 'An error occurred during the version check.',
            411 => 'An error occurred while getting the information list.',
            412 => 'An error occurred while creating the barcode.',
            500 => 'Please update the app.',
            600 => 'Under maintenance',
        ]
    ],
    'elevation' => [
        'base_url' => 'https://cyberjapandata2.gsi.go.jp/general/dem/scripts/getelevation.php'
    ],
];
