<?php
declare(strict_types=1);

namespace App\Api\Domain\Product;


interface PriceRepositoryInterface
{
    public function save(Price $price): void;
}