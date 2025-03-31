<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ProductExists extends Constraint
{
    public string $message = 'Product with ID "{{ value }}" does not exist.';
}