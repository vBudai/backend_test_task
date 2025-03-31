<?php

namespace App\DTO\Request;

use App\Validator\Constraints as AppAssert;
use Symfony\Component\Validator\Constraints as Assert;

class PriceCalculationRequest
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Type('integer')]
        #[AppAssert\ProductExists]
        public int $product,

        #[Assert\NotBlank]
        #[Assert\Type('string')]
        #[AppAssert\TaxNumber]
        public string  $taxNumber,

        #[Assert\Type('string')]
        #[Assert\Length(max: 64)]
        #[AppAssert\CouponExists]
        public ?string $couponCode = null,
    ){}
}