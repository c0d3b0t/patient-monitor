<?php

return [
    'account_sid' => env('TWILIO_ACCOUNT_SID'),
    'auth_token' => env('TWILIO_AUTH_TOKEN'),
    'from_number' => env('TWILIO_FROM_NUMBER'),
    'authy' => [
        'prod_api_key' => env('TWILIO_AUTHY_PROD_KEY')
    ]
];
