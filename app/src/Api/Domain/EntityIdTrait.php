<?php
declare(strict_types=1);

namespace App\Api\Domain;


use Doctrine\ORM\Mapping as ORM;
use Swagger\Annotations as SWG;
use Symfony\Component\Uid\Uuid;

trait EntityIdTrait
{
    /**
     * The unique auto incremented primary key.
     *
     * @var int|null
     *
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned": true})
     * @ORM\GeneratedValue
     */
    protected int $id;

    /**
     * @var Uuid
     *
     * @ORM\Column(type="uuid", unique=true)
     * @SWG\Property(type="string", format="uuid")
     */
    protected Uuid $uuid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?Uuid
    {
        return $this->uuid;
    }
}