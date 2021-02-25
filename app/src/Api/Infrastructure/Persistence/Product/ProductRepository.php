<?php
declare(strict_types=1);

namespace App\Api\Infrastructure\Persistence\Product;



use App\Api\Domain\Product\Product;
use App\Api\Infrastructure\Persistence\BaseRepository;

/**
 * Class ProductRepository
 * @package App\Api\Repository\Product
 *
 */
class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    private const ITEMS_LIMIT = 10;

    public function getForListWithPrice(int $page): array
    {
        return $this->em->createQueryBuilder()
            ->select('p, price')
            ->from(Product::class, 'p')
            ->join('p.price', 'price')
            ->orderBy('p.createdAt', 'DESC')
            ->setFirstResult(($page - 1) * self::ITEMS_LIMIT)
            ->setMaxResults(self::ITEMS_LIMIT)
            ->getQuery()
            ->getResult();
    }

    public function getPageCount(): int
    {
        $items = $this->em->createQueryBuilder()
            ->select('p.id')
            ->from(Product::class, 'p')
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery()
            ->getResult();

        $pagesNum = (int) floor(count($items) / self::ITEMS_LIMIT);

        if($items % self::ITEMS_LIMIT !== 0) {
            $pagesNum++;
        }

        return $pagesNum;
    }

    public function save(Product $product): void
    {
        $this->em->persist($product);
        $this->em->flush();
    }
}