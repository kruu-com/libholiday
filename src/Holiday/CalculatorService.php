<?php

namespace Holiday;

use Holiday\Exception\CalculatorException;

class CalculatorService
{
    /**
     * @param string $country
     * @param null|string $state
     * @return Calculator
     * @throws CalculatorException
     */
    public function getCalculatorByCountryAndState(string $country, ?string $state = null): Calculator
    {
        $country = ucfirst(strtolower($country));

        if (null === $state) {
            $className = sprintf('Holiday\\%s\\%s', $country, $country);
        } else {
            $state = ucfirst(strtolower($state));
            $className = sprintf('Holiday\\%s\\%s%s', $country, $country, $state);
        }

        if (class_exists($className)) {
            return new $className();
        }

        throw new CalculatorException('Country not available');
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
