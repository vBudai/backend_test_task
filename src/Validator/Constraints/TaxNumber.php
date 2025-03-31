<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class TaxNumber extends Constraint
{
    public string $unsupportedCountryMessage = 'Country with "{{ value }}" code is not supported.';
    public string $wrongFormatMessage = 'Wrong tax number format for country "{{ value }}".';
}