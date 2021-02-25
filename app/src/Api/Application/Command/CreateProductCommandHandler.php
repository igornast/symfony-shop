<?php
declare(strict_types=1);

namespace App\Api\Application\Command;


use App\Api\Domain\Product\Event\ProductCreatedEvent;
use App\Api\Domain\Product\PriceFactoryInterface;
use App\Api\Domain\Product\ProductFactoryInterface;
use App\Api\Infrastructure\Persistence\Price\PriceRepositoryInterface;
use App\Api\Infrastructure\Persistence\Product\ProductRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

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
    /**
     * @var EventDispatcherInterface
     */
    private EventDispatcherInterface $dispatcher;

    public function __construct(
        ProductFactoryInterface $productFactory,
        PriceFactoryInterface $priceFactory,
        ProductRepositoryInterface $productRepository,
        PriceRepositoryInterface $priceRepository,
        EventDispatcherInterface $dispatcher
    ) {
        $this->productRepository = $productRepository;
        $this->productFactory = $productFactory;
        $this->priceFactory = $priceFactory;
        $this->priceRepository = $priceRepository;
        $this->dispatcher = $dispatcher;
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

        $this->dispatcher->dispatch(new ProductCreatedEvent($product->getName()));
    }
}