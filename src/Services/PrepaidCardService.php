<?php

namespace Fintech\Card\Services;

use Fintech\Card\Interfaces\PrepaidCardRepository;
use Fintech\Core\Abstracts\BaseModel;
use Fintech\Core\Enums\Card\PrepaidCardStatus;
use Str;
use function auth;
use function fake;
use function now;

/**
 * Class PrepaidCardService
 */
class PrepaidCardService
{
    /**
     * PrepaidCardService constructor.
     */
    public function __construct(private readonly PrepaidCardRepository $prepaidCardRepository)
    {
    }

    /**
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->prepaidCardRepository->list($filters);

    }

    private function setTimeline(&$timeline, $status = 'pending', $note = null)
    {
        if ($timeline == null) {
            $timeline = [[]];
        }

        $previous = end($timeline);

        $timeline[] = [
            'previus_status' => $previous['current_status'] ?? null,
            'current_status' => $status,
            'dateime' => now(),
            'note' => $note,
            'user_id' => auth()->id(),
        ];
    }

    public function create(array $inputs = [])
    {
        $inputs['name'] = Str::upper($inputs['name']);
        $inputs['number'] = fake()->creditCardNumber(($inputs['scheme'] == 'visa' ? 'Visa' : 'MasterCard'), true);
        $inputs['cvc'] = mt_rand(100, 999);
        $inputs['pin'] = mt_rand(1000, 9999);
        $inputs['provider'] = 'default';
        $inputs['status'] = PrepaidCardStatus::Pending->value;
        $inputs['balance'] = 0;
        $inputs['issued_at'] = now();
        $inputs['expired_at'] = now()->addYears(5);
        $inputs['timeline'] = [];
        $inputs['note'] = $inputs['note'] ?? null;
        $this->setTimeline($inputs['timeline'], $inputs['status'], $inputs['note']);

        return $this->prepaidCardRepository->create($inputs);
    }

    public function find($id, $onlyTrashed = false)
    {
        return $this->prepaidCardRepository->find($id, $onlyTrashed);
    }

    public function update($id, array $inputs = [])
    {
        return $this->prepaidCardRepository->update($id, $inputs);
    }

    public function destroy($id)
    {
        return $this->prepaidCardRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->prepaidCardRepository->restore($id);
    }

    public function export(array $filters)
    {
        return $this->prepaidCardRepository->list($filters);
    }

    public function import(array $filters)
    {
        return $this->prepaidCardRepository->create($filters);
    }

    public function statusChange(BaseModel $prepaidCard, array $inputs = [])
    {
        $timeline = $prepaidCard->timeline;

        $this->setTimeline($timeline, $inputs['status'], $inputs['note']);

        return $this->prepaidCardRepository->update($prepaidCard->id, [
            'status' => $inputs['status'],
            'note' => $inputs['note'],
            'timeline' => $timeline,
        ]);
    }
}
