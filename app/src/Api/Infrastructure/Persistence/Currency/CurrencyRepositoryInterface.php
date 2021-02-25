<?php
declare(strict_types=1);

namespace App\Api\Infrastructure\Persistence\Currency;


use App\Api\Domain\Product\Currency;

interface CurrencyRepositoryInterface
{
    public function find(string $id): Currency;
}