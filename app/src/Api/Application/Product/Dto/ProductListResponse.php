<?php
declare(strict_types=1);

namespace App\Api\Application\Product\Dto;


use App\Api\Domain\Product\Product;
use Symfony\Component\Serializer\Annotation\Groups;

class ProductListResponse
{
    /**
     * @var Product[]
     * @Groups({"product_list"})
     */
    public array $items;

    /**
     * @var int
     * @Groups({"product_list"})
     */
    public int $currentPage;

    /**
     * @var int
     * @Groups({"product_list"})
     */
    public int $pageCount;

    public static function create(array $items, int $currentPage, int $pageCount): self
    {
        $obj = new self();
        $obj->items = $items;
        $obj->currentPage = $currentPage;
        $obj->pageCount = $pageCount;

        return $obj;
    }
}