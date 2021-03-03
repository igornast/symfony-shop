<?php
declare(strict_types=1);

namespace App\Api\Infrastructure\Persistence\Price;


use App\Api\Domain\Product\Price;
use App\Api\Domain\Product\PriceRepositoryInterface;
use App\Api\Infrastructure\Persistence\BaseRepository;

class PriceRepository extends BaseRepository implements PriceRepositoryInterface
{
    public function save(Price $price): void
    {
        $this->em->persist($price);
        $this->em->flush();
    }
}