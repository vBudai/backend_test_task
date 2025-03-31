<?php

namespace App\Service\Price;

use App\DTO\Request\PriceCalculationRequest;
use App\Exception\InvalidCouponException;
use App\Exception\InvalidTaxNumberException;
use App\Repository\ProductRepository;
use App\Service\Coupon\CouponApplier;
use App\Service\Tax\TaxApplier;

class PriceCalculator
{
    public function __construct(
        private ProductRepository $productRepo,
        private CouponApplier $couponApplier,
    ) {}

    /**
     * @throws InvalidCouponException
     * @throws InvalidTaxNumberException
     */
    public function calculate(PriceCalculationRequest $request): float
    {
        $product = $this->productRepo->find($request->product);
        $price = $product->getPrice();

        if ($request->couponCode) {
            $price = $this->couponApplier->apply($price, $request->couponCode);
        }

        $price = TaxApplier::apply($price, $request->taxNumber);
        return round($price, 2);
    }
}