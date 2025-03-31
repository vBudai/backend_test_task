<?php

namespace App\DTO\Response;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationErrorResponse extends ErrorResponse
{
    public function __construct(ConstraintViolationListInterface $violations)
    {
        parent::__construct(
            Response::HTTP_UNPROCESSABLE_ENTITY,
            'Validation failed',
            $this->normalizeViolations($violations)
        );
    }

    protected function normalizeViolations(ConstraintViolationListInterface $violations): array
    {
        $errors = [];
        foreach ($violations as $violation) {
            $errors[$violation->getPropertyPath()] = $violation->getMessage();
        }
        return $errors;
    }
}