<?php

namespace Fintech\Card\Repositories\Mongodb;

use Fintech\Card\Interfaces\PrepaidCardRepository as InterfacesPrepaidCardRepository;
use Fintech\Card\Models\PrepaidCard;
use Fintech\Core\Repositories\MongodbRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class PrepaidCardRepository
 */
class PrepaidCardRepository extends MongodbRepository implements InterfacesPrepaidCardRepository
{
    public function __construct()
    {
        parent::__construct(config('fintech.card.prepaid_card_model', PrepaidCard::class));
    }

    /**
     * return a list or pagination of items from
     * filtered options
     *
     * @return Paginator|Collection
     */
    public function list(array $filters = [])
    {
        $query = $this->model->newQuery();

        //Searching
        if (!empty($filters['search'])) {
            if (is_numeric($filters['search'])) {
                $query->where($this->model->getKeyName(), 'like', "%{$filters['search']}%");
            } else {
                $query->where('name', 'like', "%{$filters['search']}%");
                $query->orWhere('instant_card_data', 'like', "%{$filters['search']}%");
            }
        }

        //Display Trashed
        if (isset($filters['trashed']) && $filters['trashed'] === true) {
            $query->onlyTrashed();
        }

        //Handle Sorting
        $query->orderBy($filters['sort'] ?? $this->model->getKeyName(), $filters['dir'] ?? 'asc');

        //Execute Output
        return $this->executeQuery($query, $filters);

    }
}
