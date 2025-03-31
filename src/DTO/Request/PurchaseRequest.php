<?php

namespace App\DTO\Request;

use App\Validator\Constraints as AppAssert;
use Symfony\Component\Validator\Constraints as Assert;

class PurchaseRequest extends PriceCalculationRequest
{
    public function __construct(
        public int $product,
        public string  $taxNumber,
        public ?string $couponCode,

        #[Assert\NotBlank]
        #[Assert\Type('string')]
        #[AppAssert\PaymentProcessor]
        public string $paymentProcessor = ''
    ){
        parent::__construct($product, $taxNumber, $couponCode);
    }
}