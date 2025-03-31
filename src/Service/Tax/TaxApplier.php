<?php

namespace App\Service\Tax;

use App\Exception\InvalidTaxNumberException;

class TaxApplier
{
    /**
     * @throws InvalidTaxNumberException
     */
    public static function apply(float $price, string $taxNumber): float
    {
        $countryCode = substr($taxNumber, 0, 2);

        if (!in_array($countryCode, Country::values())) {
            throw new InvalidTaxNumberException(
                $countryCode,
                Country::values()
            );
        }

        return $price * (1 + Country::rates()[$countryCode]);
    }
}