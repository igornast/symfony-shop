<?php
declare(strict_types=1);

namespace App\Api\Domain\Product;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 */
class Currency
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string", length=20)
     */
    private string $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     * @Groups({"product_list"})
     */
    private string $name;

    public static function create(string $id, string $name): self
    {
        $obj = new self();
        $obj->id = $id;
        $obj->name = $name;

        return $obj;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}