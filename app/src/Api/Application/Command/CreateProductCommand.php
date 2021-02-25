<?php
declare(strict_types=1);

namespace App\Api\Application\Command;


class CreateProductCommand implements CommandInterface
{
    public string $name;

    public string $description;

    public int $amount;

    public string $currencyId;

    public static function create(string $name, string $description, int $amount, string $currencyId): self
    {
        $obj = new self;
        $obj->name = $name;
        $obj->description = $description;
        $obj->amount = $amount;
        $obj->currencyId = $currencyId;

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
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrencyId(): string
    {
        return $this->currencyId;
    }
}