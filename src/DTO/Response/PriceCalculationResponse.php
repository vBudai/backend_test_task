<?php

namespace App\DTO\Response;

class PriceCalculationResponse extends SuccessResponse
{
    public function __construct(
        public float $price
    ) {
        parent::__construct(
            data: ['price' => $price]
        );
    }
}