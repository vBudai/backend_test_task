<?php

namespace App\Service\Coupon;

use App\Exception\InvalidCouponException;
use App\Repository\CouponRepository;

class CouponApplier
{
    public function __construct(protected CouponRepository $repo){}

    /**
     * @throws InvalidCouponException
     */
    public function apply(int $price, string $couponCode): float
    {
        if($coupon = $this->repo->findOneBy(['code' => $couponCode])){
            return $price * (1 - $coupon->getDiscount() / 100);
        }

        throw new InvalidCouponException($couponCode);
    }

}