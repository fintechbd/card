<?php

namespace Fintech\Card\Repositories\Eloquent;

use Fintech\Card\Interfaces\PrepaidCardRepository as InterfacesPrepaidCardRepository;
use Fintech\Core\Repositories\EloquentRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class PrepaidCardRepository
 */
class PrepaidCardRepository extends EloquentRepository implements InterfacesPrepaidCardRepository
{
    public function __construct()
    {
        parent::__construct(config('fintech.card.prepaid_card_model', \Fintech\Card\Models\PrepaidCard::class));
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
            $query->where($this->model->getKeyName(), 'like', "%{$filters['search']}%");
            $query->orWhere('name', 'like', "%{$filters['search']}%");
            $query->orWhere('type', 'like', "%{$filters['search']}%");
            $query->orWhere('scheme', 'like', "%{$filters['search']}%");
            $query->orWhere('number', 'like', "%{$filters['search']}%");
            $query->orWhere('cvc', 'like', "%{$filters['search']}%");
            $query->orWhere('provider', 'like', "%{$filters['search']}%");
            $query->orWhere('status', 'like', "%{$filters['search']}%");
            $query->orWhere('block_reason', 'like', "%{$filters['search']}%");
            $query->orWhere('note', 'like', "%{$filters['search']}%");
            $query->orWhere('instant_card_data', 'like', "%{$filters['search']}%");
            $query->orWhereHas('userAccount', function ($query) use ($filters) {
                return $query->where('user_account_data', 'like', "%{$filters['search']}%");
            });
        }

        //Display Trashed
        if (!empty($filters['user_id'])) {
            $query->where('user_id', '=', $filters['user_id']);
        }

        if (!empty($filters['user_account_id'])) {
            $query->where('user_account_id', '=', $filters['user_account_id']);
        }

        if (!empty($filters['type'])) {
            $query->where('type', '=', $filters['type']);
        }

        if (!empty($filters['scheme'])) {
            $query->where('scheme', '=', $filters['scheme']);
        }

        if (!empty($filters['provider'])) {
            $query->where('provider', '=', $filters['provider']);
        }

        if (!empty($filters['status'])) {
            $query->whereIn('status', (array)$filters['status']);
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
