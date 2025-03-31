<?php

namespace App\Service\Payment\Adapter;

interface PaymentAdapterInterface
{
    public function pay(float $price);
}