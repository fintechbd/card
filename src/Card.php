<?php

namespace Fintech\Card;

use Fintech\Card\Services\PrepaidCardService;

class Card
{
    /**
     * @return PrepaidCardService
     */
    public function prepaidCard($filters = null)
{
	return \singleton(PrepaidCardService::class, $filters);
    }

    //** Crud Service Method Point Do not Remove **//

}
