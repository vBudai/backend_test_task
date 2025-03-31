<?php

namespace App\Validator\Constraints;

use App\Service\Tax\Country;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TaxNumberValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        $country = substr($value, 0, 2);
        $number  = substr($value, 2);

        if (!in_array($country, Country::values())) {
            $this->context
                ->buildViolation($constraint->unsupportedCountryMessage)
                ->setParameter('{{ value }}', $country)
                ->addViolation();
            return;
        }

        if (!preg_match(Country::formats()[$country], $number)) {
            $this->context
                ->buildViolation($constraint->wrongFormatMessage)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}