<?php
declare(strict_types=1);

namespace App\Api\Domain\Product;


interface CurrencyRepositoryInterface
{
    public function find(string $id): Currency;
}