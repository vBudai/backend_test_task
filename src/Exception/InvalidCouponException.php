<?php

namespace App\Exception;

class InvalidCouponException extends \Exception
{
    public function __construct(string $couponCode)
    {
        parent::__construct(
            sprintf('Invalid coupon code: %s', $couponCode),
            $code,
            $previous
        );
    }
}