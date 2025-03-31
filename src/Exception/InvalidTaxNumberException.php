<?php

namespace App\Exception;

class InvalidTaxNumberException extends \Exception
{
    public function __construct(
        string $countryCode,
        array $supportedCountries
    ) {
        parent::__construct(sprintf(
            "Unsupported country code in taxNumber: \"%s\". \nSupported codes: %s",
            $countryCode,
            implode(', ', $supportedCountries)
        ));
    }
}