<?php

namespace Fintech\Card;

class Card
{
    /**
     * @return \Fintech\Card\Services\InstantCardService
     */
    public function instantCard()
    {
        return app(\Fintech\Card\Services\InstantCardService::class);
    }

    //** Crud Service Method Point Do not Remove **//

}
