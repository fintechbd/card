<?php

namespace Fintech\Card\Facades;

use Fintech\Card\Services\PrepaidCardService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static PrepaidCardService prepaidCard()
 *
 * // Crud Service Method Point Do not Remove //
 *
 * @see \Fintech\Card\Card
 */
class Card extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Fintech\Card\Card::class;
    }
}
