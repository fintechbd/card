<?php

namespace Fintech\Card\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Fintech\Card\Services\PrepaidCardService prepaidCard()
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
