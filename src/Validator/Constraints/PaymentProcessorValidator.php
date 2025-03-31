<?php

namespace App\Validator\Constraints;

use App\Service\Payment\PaymentSystem;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PaymentProcessorValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        if(!in_array($value, PaymentSystem::values())){
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}