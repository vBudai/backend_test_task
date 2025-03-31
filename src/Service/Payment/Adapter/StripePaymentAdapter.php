<?php

namespace App\Service\Payment\Adapter;

use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

class StripePaymentAdapter implements PaymentAdapterInterface
{

    public function __construct(
        protected StripePaymentProcessor $paymentProcessor
    ){}

    /**
     * @throws \Exception
     */
    public function pay(float $price): void
    {
        if(!$this->paymentProcessor->processPayment($price)){
            throw new \Exception('Payment with stripe failed');
        }
    }
}