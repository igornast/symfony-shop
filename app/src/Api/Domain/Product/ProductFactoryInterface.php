<?php
declare(strict_types=1);

namespace App\Api\Domain\Product;


interface ProductFactoryInterface
{
    public function create(string $name, string $description): Product;
}