<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class PaymentProcessor extends Constraint
{
    public string $message = "Unsupported payment system";
}