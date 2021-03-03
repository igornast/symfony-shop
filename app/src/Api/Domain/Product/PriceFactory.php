<?php
declare(strict_types=1);

namespace App\Api\Domain\Product;


class PriceFactory implements PriceFactoryInterface
{
    /**
     * @var CurrencyRepositoryInterface
     */
    private CurrencyRepositoryInterface $currencyRepository;

    public function __construct(CurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function create(Product $product, string $currencyId, int $amount): Price
    {
        $currency = $this->currencyRepository->find($currencyId);

        return Price::create($product, $currency, $amount);
    }
}