<?php

namespace App\Fixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    protected const array PRODUCTS = [
        ['name' => 'Iphone', 'price' => 100],
        ['name' => 'Headphones', 'price' => 20],
        ['name' => 'Case', 'price' => 10],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PRODUCTS as $product) {
            $productEntity = new Product();
            $productEntity
                ->setName($product['name'])
                ->setPrice($product['price']);

            $manager->persist($productEntity);
        }

        $manager->flush();
    }
}