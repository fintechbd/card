<?php

namespace Fintech\Card\Http\Resources;

use Carbon\Carbon;
use Fintech\Core\Supports\Constant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Str;

class PrepaidCardCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($prepaidCard) {

            return [
                'id' => $prepaidCard->getKey(),
                'user_id' => $prepaidCard->user_id,
                'user_name' => $prepaidCard->user->name ?? null,
                'user_account_id' => $prepaidCard->user_account_id ?? null,
                'user_account_currency' => $prepaidCard->userAccount->user_account_data ?? (object) [],
                'user_account_country_id' => $prepaidCard->userAccount->country_id ?? null,
                'type' => $prepaidCard->type ?? null,
                'scheme' => $prepaidCard->scheme ?? null,
                'name' => $prepaidCard->name ?? null,
                'number' => Str::mask(($prepaidCard->number ?? '1234-5678-9123-4567'), '*', 0, -4),
                'cvc' => Str::mask(($prepaidCard->cvc ?? '123'), '*', 0),
                'provider' => $prepaidCard->provider ?? null,
                'status' => $prepaidCard->status ?? null,
                'note' => $prepaidCard->note ?? null,
                'balance' => $prepaidCard->balance ?? null,
                'instant_card_data' => $prepaidCard->instant_card_data ?? (object) [],
                'approver_id' => $prepaidCard->approver_id ?? null,
                'approver_name' => $prepaidCard->approver?->name ?? null,
                'issued_date_label' => Carbon::parse($prepaidCard->issued_at)->format('m/y'),
                'expired_date_label' => Carbon::parse($prepaidCard->expired_at)->format('m/y'),
                'issued_at' => $prepaidCard->issued_at,
                'expired_at' => $prepaidCard->expired_at,
                'created_at' => $prepaidCard->created_at,
                'updated_at' => $prepaidCard->updated_at,
            ];
        })->toArray();
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @return array<string, mixed>
     */
    public function with(Request $request): array
    {
        return [
            'options' => [
                'dir' => Constant::SORT_DIRECTIONS,
                'per_page' => Constant::PAGINATE_LENGTHS,
                'sort' => ['id', 'name', 'created_at', 'updated_at'],
            ],
            'query' => $request->all(),
        ];
    }
}
