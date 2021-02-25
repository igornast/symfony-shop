<?php
declare(strict_types=1);

namespace App\Api\Domain\Product;


class ProductFactory implements ProductFactoryInterface
{
    public function create(string $name, string $description): Product
    {
        return Product::create($name, $description);
    }
}