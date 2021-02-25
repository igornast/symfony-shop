<?php

namespace App\DataFixtures;

use App\Api\Application\Constants\DefinedCurrency;
use App\Api\Domain\Product\Currency;
use App\Api\Domain\Product\Price;
use App\Api\Domain\Product\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private \Faker\Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        $currency = Currency::create(DefinedCurrency::ID_PLN, DefinedCurrency::NAME_PLN);
        $manager->persist($currency);

        for ($i = 1; $i <= 45; $i++) {
            $product = Product::create($this->faker->word, $this->faker->text(300));
            $price = Price::create($product, $currency, $this->faker->numberBetween(1000, 9900));
            $manager->persist($product);
            $manager->persist($price);
        }

        $manager->flush();
    }
}
