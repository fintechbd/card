<?php

namespace Fintech\Card\Repositories\Eloquent;

use Fintech\Card\Interfaces\InstantCardRepository as InterfacesInstantCardRepository;
use Fintech\Core\Repositories\EloquentRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class InstantCardRepository
 */
class InstantCardRepository extends EloquentRepository implements InterfacesInstantCardRepository
{
    public function __construct()
    {
        parent::__construct(config('fintech.card.instant_card_model', \Fintech\Card\Models\InstantCard::class));
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
        if (! empty($filters['search'])) {
            if (is_numeric($filters['search'])) {
                $query->where($this->model->getKeyName(), 'like', "%{$filters['search']}%");
            } else {
                $query->where('name', 'like', "%{$filters['search']}%");
                $query->orWhere('instant_card_data', 'like', "%{$filters['search']}%");
            }
        }

        //Display Trashed
        if (! empty($filters['user_id'])) {
            $query->where('user_id', '=', $filters['user_id']);
        }

        if (! empty($filters['user_account_id'])) {
            $query->where('user_account_id', '=', $filters['user_account_id']);
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
