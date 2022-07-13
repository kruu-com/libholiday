<?php

namespace Holiday;

use Holiday\Exception\CalculatorException;
use Holiday\Exception\CalculatorForStateNotAvailableException;

class CalculatorService
{
    /**
     * @param string $country
     * @param null|string $state
     * @return Calculator
     * @throws CalculatorException
     * @throws CalculatorForStateNotAvailableException
     */
    public function getCalculatorByCountryAndState(string $country, ?string $state = null): Calculator
    {
        $country = ucfirst(strtolower($country));

        $countryCalculatorClassName = sprintf('Holiday\\%s\\%s', $country, $country);

        if (!class_exists($countryCalculatorClassName)) {
            throw new CalculatorException('Country not available');
        }

        $countryCalculator = new $countryCalculatorClassName();

        if (null !== $state) {
            $state = ucfirst(strtolower($state));
            $countryStateCalculatorClassName = sprintf('Holiday\\%s\\%s%s', $country, $country, $state);

            if (!class_exists($countryStateCalculatorClassName)) {
                throw new CalculatorForStateNotAvailableException(sprintf('Calculator for country %s and state %s does not exists.', $country, $state), $countryCalculator);
            }

            return new $countryStateCalculatorClassName();
        }

        return $countryCalculator;
    }

    /**
     * @param \DateTime $date
     * @param string $country
     * @param string|null $state
     * @return null|iterable|Holiday[]
     */
    public function getHolidayForDate(\DateTime $date, string $country, string $state = null): ?iterable
    {
        $calculator = $this->getCalculatorByCountryAndState($country, $state);

        return $calculator->isHoliday($date);
    }
}
