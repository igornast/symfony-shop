<?php
declare(strict_types=1);

namespace App\Api\Domain\Product;


interface PriceFactoryInterface
{
    public function create(Product $product, string $currencyId, int $amount): Price;
}