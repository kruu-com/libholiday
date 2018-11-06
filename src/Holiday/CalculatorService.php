<?php

namespace Holiday;

use Holiday\Exception\CalculatorException;

class CalculatorService
{
    public function getCalculatorByCountryAndState(string $country, string $state = null): Calculator
    {
        $country = ucfirst(strtolower($country));
        $state = ucfirst(strtolower($state));

        if (null === $state) {
            $className = sprintf('Holiday\\%s\\%s', $country, $country);
        } else {
            $className = sprintf('Holiday\\%s\\%s%s', $country, $country, $state);
        }

        if (class_exists($className)) {
            return new $className();
        }

        throw new CalculatorException('Country not available');
    }

    public function isHoliday(\DateTime $date, string $country, string $state = null)
    {
        $calculator = $this->getCalculatorByCountryAndState($country, $state);

        return $calculator->isHoliday($date);
    }
}
