<?php

namespace Fintech\Card\Repositories\Eloquent;

use Fintech\Card\Interfaces\PrepaidCardRepository as InterfacesPrepaidCardRepository;
use Fintech\Card\Models\PrepaidCard;
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
        if (! empty($filters['search'])) {
            $query->where(function ($query) use ($filters) {
                return $query->where('name', 'like', "%{$filters['search']}%")
                    ->orWhere('type', 'like', "%{$filters['search']}%")
                    ->orWhere('scheme', 'like', "%{$filters['search']}%")
                    ->orWhere('number', 'like', "%{$filters['search']}%")
                    ->orWhere('provider', 'like', "%{$filters['search']}%")
                    ->orWhere('block_reason', 'like', "%{$filters['search']}%")
                    ->orWhere('note', 'like', "%{$filters['search']}%")
                    ->orWhere('instant_card_data', 'like', "%{$filters['search']}%");
            });
        }

        //Display Trashed
        if (! empty($filters['user_id'])) {
            $query->where('user_id', '=', $filters['user_id']);
        }

        if (! empty($filters['user_account_id'])) {
            $query->where('user_account_id', '=', $filters['user_account_id']);
        }

        if (! empty($filters['type'])) {
            $query->where('type', '=', $filters['type']);
        }

        if (! empty($filters['scheme'])) {
            $query->where('scheme', '=', $filters['scheme']);
        }

        if (! empty($filters['provider'])) {
            $query->where('provider', '=', $filters['provider']);
        }

        if (! empty($filters['status'])) {
            $query->whereIn('status', (array) $filters['status']);
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
