<?php
declare(strict_types=1);

namespace App\Api\Domain\Product;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 */
class Price
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private int $id;

    /**
     * @var int
     * @ORM\Column(name="amount", type="integer")
     * @Groups({"product_list"})
     */
    private int $amount;

    /**
     * @var Currency
     * @ORM\ManyToOne(targetEntity="App\Api\Domain\Product\Currency")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"product_list"})
     */
    private Currency $currency;

    /**
     * @var Product
     * @ORM\OneToOne(targetEntity="App\Api\Domain\Product\Product", inversedBy="price")
     * @ORM\JoinColumn(nullable=false)
     */
    private Product $product;

    public static function create(Product $product, Currency $currency, int $amount): self
    {
        $obj = new self();
        $obj->amount = $amount;
        $obj->currency = $currency;
        $obj->product = $product;

        return $obj;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }
}