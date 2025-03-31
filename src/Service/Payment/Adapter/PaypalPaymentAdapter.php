<?php

namespace App\Service\Payment\Adapter;

use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;

class PaypalPaymentAdapter implements PaymentAdapterInterface
{

    public function __construct(protected PaypalPaymentProcessor $paymentProcessor)
    {
    }

    /**
     * @throws \Exception
     */
    public function pay(float $price): void
    {
        $this->paymentProcessor->pay($price);
    }
}