<?php

namespace Holiday\Exception;

use Holiday\Calculator;

class CalculatorForStateNotAvailableException extends \Exception
{
    private Calculator $countryCalculator;

    public function __construct(string $message, Calculator $countryCalculator)
    {
        parent::__construct($message);
        $this->countryCalculator = $countryCalculator;
    }

    public function getCountryCalculator(): Calculator
    {
        return $this->countryCalculator;
    }

}
