<?php

namespace App\Service\Payment;

use App\Exception\InvalidPaymentProcessor;
use App\Service\Payment\Adapter\PaymentAdapterInterface;
use App\Service\Payment\Adapter\PaypalPaymentAdapter;
use App\Service\Payment\Adapter\StripePaymentAdapter;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

class PaymentProcessorFactory
{
    /**
     * @throws \Exception
     */
    public static function create(string $paymentProcessor): PaymentAdapterInterface
    {
        return match ($paymentProcessor) {
            'paypal' => new PaypalPaymentAdapter(new PaypalPaymentProcessor()),
            'stripe' => new StripePaymentAdapter(new StripePaymentProcessor()),
            default  => throw new InvalidPaymentProcessor(
                $paymentProcessor,
                PaymentSystem::values()
            ),
        };
    }
}