<?php

return [
    /**
     * Enable Goodwall protection functionality
     */
    'enabled' => env('GOODWALL_ENABLED', true),

    /**
     * Response code in case of hitting the Goodwall protection (BehindGoodwall)
     */
    'restricted_response_code' => 404,

    /**
     * Response code in case of accessing CanModifyGoodwall with wrong API Key
     */
    'forbidden_response_code' => 403,

    /**
     * Response code in case of accessing CanModifyGoodwall with wrong Signature
     */
    'bad_request_response_code' => 400,

    /**
     * Response code in case of successful deletion
     */
    'deleted_response_code' => 204,

    /**
     * API Key to access data
     */
    'api_key' => env('GOODWALL_API_KEY', ''),

    /**
     * Secret Key to modify data
     */
    'secret_key' => env('GOODWALL_SECRET_KEY', ''),

    /**
     * Laravel validation's rules for POST and DELETE endpoints
     */
    'rules' => [
        'whitelist' => [
            'required',
            'array',
            'min:1',
            'max:25',
        ],
    ],

    /**
     * Algorithm for signatures
     */
    'signature_algo' => 'sha256',
];
