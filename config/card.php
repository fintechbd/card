<?php

// config for Fintech/Card
return [

    /*
    |--------------------------------------------------------------------------
    | Enable Module APIs
    |--------------------------------------------------------------------------
    | This setting enable the API will be available or not
    */
    'enabled' => env('PACKAGE_CARD_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Card Group Root Prefix
    |--------------------------------------------------------------------------
    |
    | This value will be added to all your routes from this package
    | Example: APP_URL/{root_prefix}/api/card/action
    |
    | Note: while adding prefix add closing ending slash '/'
    */

    'root_prefix' => 'test/',

    /*
    |--------------------------------------------------------------------------
    | InstantCard Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'prepaid_card_model' => \Fintech\Card\Models\PrepaidCard::class,

    //** Model Config Point Do not Remove **//

    /*
    |--------------------------------------------------------------------------
    | Repositories
    |--------------------------------------------------------------------------
    |
    | This value will be used across systems where a repositoy instance is needed
    */

    'repositories' => [
        \Fintech\Card\Interfaces\PrepaidCardRepository::class => \Fintech\Card\Repositories\Eloquent\PrepaidCardRepository::class,

        //** Repository Binding Config Point Do not Remove **//
    ],

];
