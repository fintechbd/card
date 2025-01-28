<?php

// config for Fintech/Card
use Fintech\Card\Models\PrepaidCard;
use Fintech\Card\Repositories\Eloquent\PrepaidCardRepository;

return [

    /*
    |--------------------------------------------------------------------------
    | Enable Module APIs
    |--------------------------------------------------------------------------
    | This setting enable the API will be available or not
    */
    'enabled' => env('CARD_ENABLED', true),

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

    'root_prefix' => 'api/',

    /*
    |--------------------------------------------------------------------------
    | InstantCard Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'prepaid_card_model' => PrepaidCard::class,

    //** Model Config Point Do not Remove **//

    /*
    |--------------------------------------------------------------------------
    | Repositories
    |--------------------------------------------------------------------------
    |
    | This value will be used across systems where a repository instance is needed
    */

    'repositories' => [
        \Fintech\Card\Interfaces\PrepaidCardRepository::class => PrepaidCardRepository::class,

        //** Repository Binding Config Point Do not Remove **//
    ],

];
