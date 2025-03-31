<?php

namespace App\Service\Payment\Adapter;

use App\Exception\PaymentProcessingException;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;

class PaypalPaymentAdapter implements PaymentAdapterInterface
{

    public function __construct(protected PaypalPaymentProcessor $paymentProcessor)
    {
    }

    /**
     * @throws PaymentProcessingException
     */
    public function pay(float $price): void
    {
        try{
            $this->paymentProcessor->pay($price);
        } catch (\Exception $e) {
            throw new PaymentProcessingException($e->getMessage(), $e->getCode(), $e);
        }
    }
}