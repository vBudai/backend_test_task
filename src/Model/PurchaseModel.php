<?php

namespace App\Model;

use App\DTO\Request\PurchaseRequest;
use App\Exception\InvalidCouponException;
use App\Exception\InvalidTaxNumberException;
use App\Service\Payment\PaymentProcessorFactory;
use App\Service\Price\PriceCalculator;
use Exception;

class PurchaseModel
{
    public function __construct(
        protected PriceCalculator $priceCalculator,
    ){}

    /**
     * @throws InvalidCouponException
     * @throws InvalidTaxNumberException
     * @throws Exception
     */
    public function purchase(PurchaseRequest $request): void
    {
        $price = $this->priceCalculator->calculate($request);

        $paymentProcessor = PaymentProcessorFactory::create($request->paymentProcessor);
        $paymentProcessor->pay($price);
    }
}