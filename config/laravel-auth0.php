<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Your auth0 domain
    |--------------------------------------------------------------------------
    | As set in the auth0 administration page
    |--------------------------------------------------------------------------
    */
    'domain' => env( 'AUTH0_DOMAIN', 'a7x3.us.auth0.com' ),

    /*
    |--------------------------------------------------------------------------
    | Your APP id
    |--------------------------------------------------------------------------
    | As set in the auth0 administration page
    |--------------------------------------------------------------------------
    */
    'client_id' => env( 'AUTH0_CLIENT_ID', 'D2ZvFmuNGanq7WfEK41BMDvxAjjJNLZ0' ),

    /*
    |--------------------------------------------------------------------------
    | Your APP secret
    |--------------------------------------------------------------------------
    | As set in the auth0 administration page
    |--------------------------------------------------------------------------
    */
    'client_secret' => env( 'AUTH0_CLIENT_SECRET', '1FYy4sUKGCzBE0pjNJa7bQaKQKovtCKGY0441E40Q2gNtlGMUe3oVrnZ-7Qyi4h1' ),

    /*
    |--------------------------------------------------------------------------
    | The redirect URI
    |--------------------------------------------------------------------------
    | Should be the same that the one configure in the route to handle the
    | 'Auth0\Login\Auth0Controller@callback'
    |--------------------------------------------------------------------------
    */
    'redirect_uri' => env( 'APP_URL', 'https://8638-2400-adc7-91d-db00-fadd-f5c2-f5a3-2efc.ngrok.io/' ),

    /*
    |--------------------------------------------------------------------------
    | Persistence Configuration
    |--------------------------------------------------------------------------
    | persist_user          (Boolean) Optional. Indicates if you want to persist the user info, default true
    | persist_access_token  (Boolean) Optional. Indicates if you want to persist the access token, default false
    | persist_refresh_token (Boolean) Optional. Indicates if you want to persist the refresh token, default false
    | persist_id_token      (Boolean) Optional. Indicates if you want to persist the id token, default false
    |--------------------------------------------------------------------------
    */
    'persist_user' => true,
    'persist_access_token' => false,
    'persist_refresh_token' => false,
    'persist_id_token' => false,

    /*
    |--------------------------------------------------------------------------
    | The authorized token audiences
    |--------------------------------------------------------------------------
    */
    // 'api_identifier' => '',

    /*
    |--------------------------------------------------------------------------
    | Auth0 Organizations
    |--------------------------------------------------------------------------
    | organization (string) Optional. Id of an Organization, if being used. Used when generating log in urls and validating token claims.
    |--------------------------------------------------------------------------
    */
    // 'organization' => '',

    /*
    |--------------------------------------------------------------------------
    | The secret format
    |--------------------------------------------------------------------------
    | Used to know if it should decode the secret when using HS256
    |--------------------------------------------------------------------------
    */
    'secret_base64_encoded' => false,

    /*
    |--------------------------------------------------------------------------
    | Supported algorithms
    |--------------------------------------------------------------------------
    | Token decoding algorithms supported by your API
    |--------------------------------------------------------------------------
    */
    'authorized_issuers' => [ 'https://a7x3.us.auth0.com/' ],
    'api_identifier' => 'D2ZvFmuNGanq7WfEK41BMDvxAjjJNLZ0',
    'supported_algs' => [ 'RS256' ],

    /*
    |--------------------------------------------------------------------------
    | Guzzle Options
    |--------------------------------------------------------------------------
    | guzzle_options (array) optional. Used to specify additional connection options e.g. proxy settings
    |--------------------------------------------------------------------------
    */
    // 'guzzle_options' => []
];
