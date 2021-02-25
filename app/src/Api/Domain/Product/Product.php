<?php
declare(strict_types=1);

namespace App\Api\Domain\Product;

use App\Api\Domain\EntityIdTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity()
 */
class Product
{
    use EntityIdTrait;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Groups({"product_list"})
     */
    private string $name;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @Groups({"product_list"})
     */
    private string $description;

    /**
     * @var DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    private DateTime $createdAt;

    /**
     * @var Price
     * @ORM\OneToOne(targetEntity="App\Api\Domain\Product\Price", mappedBy="product")
     * @Groups({"product_list"})
     */
    private Price $price;

    public static function create(string $name, string $description): self
    {
        $obj = new self();
        $obj->uuid = Uuid::v4();
        $obj->name = $name;
        $obj->description = $description;

        return $obj;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return Price
     */
    public function getPrice(): Price
    {
        return $this->price;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}