<?php

namespace App\Service\Payment\Adapter;

use App\Exception\PaymentProcessingException;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

class StripePaymentAdapter implements PaymentAdapterInterface
{

    public function __construct(
        protected StripePaymentProcessor $paymentProcessor
    ){}

    /**
     * @throws PaymentProcessingException
     */
    public function pay(float $price): void
    {
        if(!$this->paymentProcessor->processPayment($price)){
            throw new PaymentProcessingException('Payment with stripe failed');
        }
    }
}