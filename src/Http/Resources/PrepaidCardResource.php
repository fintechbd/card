<?php

namespace Fintech\Card\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

use function request;

class PrepaidCardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getKey(),
            'user_id' => $this->user_id,
            'user_name' => $this->user->name ?? null,
            'user_account_id' => $this->user_account_id ?? null,
            'user_account_currency' => $this->userAccount->user_account_data ?? (object) [],
            'user_account_country_id' => $this->userAccount->country_id ?? null,
            'type' => $this->type ?? null,
            'scheme' => $this->scheme ?? null,
            'name' => $this->name ?? null,
            'number' => (! request()->filled('pin'))
                ? Str::mask(($this->number ?? '1234-5678-9123-4567'), '*', 0, -4)
                : $this->number,
            'cvc' => (! request()->filled('pin'))
                ? Str::mask(($this->cvc ?? '123'), '*', 0)
                : $this->cvc,
            'provider' => $this->provider ?? null,
            'status' => $this->status ?? null,
            'note' => $this->note ?? null,
            'balance' => $this->balance ?? null,
            'instant_card_data' => $this->instant_card_data ?? (object) [],
            'approver_id' => $this->approver_id ?? null,
            'approver_name' => $this->approver?->name ?? null,
            'issued_date_label' => Carbon::parse($this->issued_at)->format('m/y'),
            'expired_date_label' => Carbon::parse($this->expired_at)->format('m/y'),
            'issued_at' => $this->issued_at,
            'expired_at' => $this->expired_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
