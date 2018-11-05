<?php

namespace Holiday;

use Holiday\Exception\CalculatorException;

class CalculatorService
{
    public function getCalculatorByCountryAndState($country, $state = null): Calculator
    {
        if (null === $country) {
            throw new CalculatorException('Country is missing');
        }

        switch (true) {
            case class_exists(sprintf('Holiday\\%s\\%s%s', $country, $country, $state)):
                $className = sprintf('Holiday\\%s\\%s%s', $country, $country, $state);
                return new $className();
                break;
            case class_exists(sprintf('Holiday\\%s\\%s', $country, $state)):
                $className = sprintf('Holiday\\%s\\%s', $country, $state);
                return new $className();
                break;
            case class_exists(sprintf('Holiday\\%s\\%s', $country, $country)):
            default:
                $className = sprintf('Holiday\\%s\\%s', $country, $country);
                return new $className();
                break;
        }
    }
}
