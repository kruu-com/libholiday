<?php
/**
 * This software is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License version 3 as published by the Free Software Foundation
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * @copyright  Copyright (c) 2012 Mayflower GmbH (http://www.mayflower.de)
 * @license    LGPL v3 (See LICENSE file)
 */
namespace Holiday\Us;

use Holiday\Calculator;
use Holiday\Holiday;

class Us extends Calculator
{
    /**
     * Get public holidays valid in states of US as well as special holidays not valid in states of Us.
     * @param int $year
     * @return array
     */
    protected function getHolidays(int $year): array
    {
        return array_merge(
            $this->getPublicHolidays($year),
            $this->getSpecial($year)
        );
    }

    /**
     * Get _public holidays_ only. Not in all states of US days from getSpecial() are public holidays.
     *
     * Moved to dedicated method in order to retain compatibility of getHolidays() with existing code.
     *
     * @param int $year Year
     * @return Holiday[]
     */
    protected function getPublicHolidays($year)
    {
        $christmas = new \DateTimeImmutable($year.'-12-25', $this->timezone);
        $thanksgiving = new \DateTimeImmutable('fourth Thursday of November '.$year, $this->timezone);
        $newYearsDay = new \DateTimeImmutable($year.'-1-1', $this->timezone);

        $holidays = [
            new Holiday(clone $christmas, 'Christmas', $this->timezone),
            new Holiday(clone $thanksgiving, 'Thanksgiving Day', $this->timezone),
            new Holiday($newYearsDay, "New Year's Day", $this->timezone),
            new Holiday(new \DateTimeImmutable($year.'-7-4', $this->timezone), 'Independence Day', $this->timezone),
            new Holiday(new \DateTimeImmutable($year.'-11-11', $this->timezone), 'Veterans Day', $this->timezone),
            new Holiday(new \DateTimeImmutable('second Monday of October '.$year, $this->timezone), 'Columbus Day', $this->timezone),
            new Holiday(new \DateTimeImmutable('first Monday of September '.$year, $this->timezone), 'Labor Day', $this->timezone),
            new Holiday(new \DateTimeImmutable('last Monday of May '.$year, $this->timezone), 'Memorial Day', $this->timezone),
            new Holiday(new \DateTimeImmutable('third Monday of February '.$year, $this->timezone), "President's Day", $this->timezone),
            new Holiday(new \DateTimeImmutable('third Monday of January '.$year, $this->timezone), 'Martin Luther King, Jr. Day', $this->timezone),
        ];

        if ($newYearsDay->format('N') === 6 || $newYearsDay->format('N') === 7) {
            new Holiday($newYearsDay->modify('+1 day'), "New Year's Day (in lieu)", $this->timezone);
        }

        $holidays[] = new Holiday($christmas->modify('-1 day'), 'Christmas Eve', $this->timezone);
        $holidays[] = new Holiday($thanksgiving->modify('+1 day'), 'Thanksgiving Adam', $this->timezone);

        return $holidays;
    }

    private function getSpecial($year)
    {
        return [];
    }
}
