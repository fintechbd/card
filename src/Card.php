<?php

namespace Fintech\Card;

class Card
{
    /**
     * @return \Fintech\Card\Services\PrepaidCardService
     */
    public function prepaidCard()
    {
        return app(\Fintech\Card\Services\PrepaidCardService::class);
    }

    //** Crud Service Method Point Do not Remove **//

}
