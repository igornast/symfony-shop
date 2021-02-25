<?php
declare(strict_types=1);

namespace App\Api\Application\Product\Dto;


use Symfony\Component\Validator\Constraints as Assert;

class ProductCreateInput
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $name;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min="100")
     */
    public string $description;

    /**
     * @var int
     * @Assert\Type(type="int")
     * @Assert\GreaterThanOrEqual(value="100")
     */
    public int $amount;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Choice(choices = {"PLN"})
     */
    public string $currency;

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
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }
}