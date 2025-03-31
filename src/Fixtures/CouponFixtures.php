<?php

namespace App\Fixtures;

use App\Entity\Coupon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CouponFixtures extends Fixture
{
    protected const array COUPONS = [
        ['code' => 'D10',  'discount' => 10],
        ['code' => 'D15',  'discount' => 15],
        ['code' => 'D50',  'discount' => 50],
        ['code' => 'D100', 'discount' => 100],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::COUPONS as $coupon) {
            $couponEntity = new Coupon();
            $couponEntity
                ->setCode($coupon['code'])
                ->setDiscount($coupon['discount']);

            $manager->persist($couponEntity);
        }

        $manager->flush();
    }
}