<?php

namespace App\Exception;

class InvalidPaymentProcessor extends \Exception
{
    public function __construct(
        string $paymentProcessor,
        array $supportedPaymentProcessors
    ) {
        parent::__construct(sprintf(
            'Payment processor "%s" is not supported. Available processors: %s',
            $paymentProcessor,
            implode(', ', $supportedPaymentProcessors)
        ));
    }
}