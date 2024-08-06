<?php

namespace Fintech\Card\Services;

use Fintech\Card\Interfaces\InstantCardRepository;
use Fintech\Core\Abstracts\BaseModel;
use Fintech\Core\Enums\Ekyc\InstantCardStatus;

/**
 * Class InstantCardService
 */
class InstantCardService
{
    /**
     * InstantCardService constructor.
     */
    public function __construct(private readonly InstantCardRepository $instantCardRepository) {}

    /**
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->instantCardRepository->list($filters);

    }

    private function setTimeline(array &$timeline = [], $status = 'pending', $note = null)
    {
        if ($timeline == null) {
            $timeline = [[]];
        }

        $previous = end($timeline);

        $timeline[] = [
            'previus_status' => $previous['current_status'] ?? null,
            'current_status' => $status,
            'dateime' => \now(),
            'note' => $note,
            'user_id' => \auth()->id(),
        ];
    }

    public function create(array $inputs = [])
    {
        $inputs['name'] = \Str::upper($inputs['name']);
        $inputs['number'] = \fake()->creditCardNumber(ucfirst($inputs['scheme']), true);
        $inputs['cvc'] = mt_rand(100, 999);
        $inputs['pin'] = mt_rand(1000, 9999);
        $inputs['provider'] = 'default';
        $inputs['status'] = InstantCardStatus::Pending->value;
        $inputs['balance'] = 0;
        $inputs['issued_at'] = \now();
        $inputs['expired_at'] = \now()->addYears(5);
        $inputs['timeline'] = [];
        $this->setTimeline($inputs['timeline'], $inputs['status'], $inputs['note']);

        return $this->instantCardRepository->create($inputs);
    }

    public function find($id, $onlyTrashed = false)
    {
        return $this->instantCardRepository->find($id, $onlyTrashed);
    }

    public function update($id, array $inputs = [])
    {
        return $this->instantCardRepository->update($id, $inputs);
    }

    public function destroy($id)
    {
        return $this->instantCardRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->instantCardRepository->restore($id);
    }

    public function export(array $filters)
    {
        return $this->instantCardRepository->list($filters);
    }

    public function import(array $filters)
    {
        return $this->instantCardRepository->create($filters);
    }

    public function statusChange(BaseModel $instantCard, array $inputs = [])
    {
        $timeline = $instantCard->timeline;

        $this->setTimeline($timeline, $inputs['status'], $inputs['note']);

        return $this->instantCardRepository->update($instantCard->id, [
            'status' => $inputs['status'],
            'note' => $inputs['note'],
            'timeline' => $timeline,
        ]);
    }
}
