<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class CouponExists extends Constraint
{
    public string $message = 'Coupon with code "{{ value }}" does not exist.';
}