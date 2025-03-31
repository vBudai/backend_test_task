<?php

namespace App\Service\Payment\Adapter;

use App\Exception\PaymentProcessingException;

interface PaymentAdapterInterface
{
    /**
     * @throws PaymentProcessingException
     */
    public function pay(float $price);
}