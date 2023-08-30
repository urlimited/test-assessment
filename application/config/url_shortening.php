<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Number of tries
    |--------------------------------------------------------------------------
    |
    | The slug is a shortened URL combination of 5 chars, therefore there might
    | be collisions in the database. We will provide 5 tries for
    | any other location as required by the application or its packages.
    |
    */

    'number_of_tries' => env('URL_SHORTENING_NUMBER_OF_TRIES', 5),

    'url_charset' => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz',

    'url_length' => 5,

    'base_url' => env('APP_URL', 'http://localhost') . '/urls',

    'old_threshold_in_days' => 30,

    'visits_threshold' => 0,
];
