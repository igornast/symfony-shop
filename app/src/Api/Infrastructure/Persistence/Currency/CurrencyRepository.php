<?php
declare(strict_types=1);

namespace App\Api\Infrastructure\Persistence\Currency;


use App\Api\Domain\Product\Currency;
use App\Api\Domain\Product\CurrencyRepositoryInterface;
use App\Api\Infrastructure\Persistence\BaseRepository;

class CurrencyRepository extends BaseRepository implements CurrencyRepositoryInterface
{
    public function find(string $id): Currency
    {
        return $this->repository->find($id);
    }
}