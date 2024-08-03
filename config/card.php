<?php

// config for Fintech/Card
return [

    /*
    |--------------------------------------------------------------------------
    | Enable Module APIs
    |--------------------------------------------------------------------------
    | This setting enable the API will be available or not
    */
    'enabled' => env('PACKAGE_Card_ENABLED', true),

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
    'instant_card_model' => \Fintech\Card\Models\InstantCard::class,

    //** Model Config Point Do not Remove **//

    /*
    |--------------------------------------------------------------------------
    | Repositories
    |--------------------------------------------------------------------------
    |
    | This value will be used across systems where a repositoy instance is needed
    */

    'repositories' => [
        \Fintech\Card\Interfaces\InstantCardRepository::class => \Fintech\Card\Repositories\Eloquent\InstantCardRepository::class,

        //** Repository Binding Config Point Do not Remove **//
    ],

];
