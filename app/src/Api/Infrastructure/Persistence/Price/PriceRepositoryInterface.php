<?php
declare(strict_types=1);

namespace App\Api\Infrastructure\Persistence\Price;


use App\Api\Domain\Product\Price;

interface PriceRepositoryInterface
{
    public function save(Price $price): void;
}