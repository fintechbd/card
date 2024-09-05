<?php

namespace Fintech\Card;

use Fintech\Card\Services\PrepaidCardService;

class Card
{
    /**
     * @return PrepaidCardService
     */
    public function prepaidCard()
    {
        return app(PrepaidCardService::class);
    }

    //** Crud Service Method Point Do not Remove **//

}
