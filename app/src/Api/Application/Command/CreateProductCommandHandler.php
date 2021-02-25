<?php
declare(strict_types=1);

namespace App\Api\Application\Command;


use App\Api\Domain\Product\PriceFactoryInterface;
use App\Api\Domain\Product\ProductFactoryInterface;
use App\Api\Infrastructure\Persistence\Price\PriceRepositoryInterface;
use App\Api\Infrastructure\Persistence\Product\ProductRepositoryInterface;

class CreateProductCommandHandler implements CommandHandlerInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;
    /**
     * @var ProductFactoryInterface
     */
    private ProductFactoryInterface $productFactory;
    /**
     * @var PriceFactoryInterface
     */
    private PriceFactoryInterface $priceFactory;
    /**
     * @var PriceRepositoryInterface
     */
    private PriceRepositoryInterface $priceRepository;

    public function __construct(
        ProductFactoryInterface $productFactory,
        PriceFactoryInterface $priceFactory,
        ProductRepositoryInterface $productRepository,
        PriceRepositoryInterface $priceRepository
    ) {
        $this->productRepository = $productRepository;
        $this->productFactory = $productFactory;
        $this->priceFactory = $priceFactory;
        $this->priceRepository = $priceRepository;
    }

    public function __invoke(CreateProductCommand $command)
    {
        $product = $this->productFactory->create(
            $command->getName(),
            $command->getDescription()
        );
        $price = $this->priceFactory->create($product, $command->getCurrencyId(), $command->getAmount());

        $this->productRepository->save($product);
        $this->priceRepository->save($price);
    }
}