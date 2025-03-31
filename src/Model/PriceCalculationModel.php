<?php

namespace App\Model;

use App\DTO\Request\PriceCalculationRequest;
use App\Exception\InvalidCouponException;
use App\Exception\InvalidTaxNumberException;
use App\Service\Price\PriceCalculator;

class PriceCalculationModel
{

    public function __construct(
        protected PriceCalculator $priceCalculator,
    ){}

    /**
     * @throws InvalidCouponException
     * @throws InvalidTaxNumberException
     */
    public function calculatePrice(PriceCalculationRequest $request): float
    {
        return $this->priceCalculator->calculate($request);
    }
}