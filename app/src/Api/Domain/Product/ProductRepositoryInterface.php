<?php
declare(strict_types=1);

namespace App\Api\Domain\Product;


interface ProductRepositoryInterface
{
    public function getForListWithPrice(int $page): array;

    public function getPageCount(): int;

    public function save(Product $product): void;
}