<?php

namespace Fintech\Card\Services;

use Fintech\Card\Interfaces\InstantCardRepository;

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

    public function create(array $inputs = [])
    {
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
}
