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
namespace Holiday\Austria;

use Holiday\Calculator;
use Holiday\Holiday;

class Austria extends Calculator
{
    /**
     * Get public holidays valid in states of Germany as well as special holidays not valid in states of Germany.
     * @param int $year
     * @return array
     */
    protected function getHolidays($year)
    {
        return array_merge(
            $this->getPublicHolidays($year),
            $this->getSpecial($year)
        );
    }

    /**
     * Get _public holidays_ only. Not in all states of Germany days from getSpecial() are public holidays.
     *
     * Moved to dedicated method in order to retain compatibility of getHolidays() with existing code.
     *
     * @param int $year Year
     * @return Holiday[]
     */
    protected function getPublicHolidays($year)
    {
        $timezone = $this->timezone;

        /** @var Holiday[] $data */
        $data = array();
        $easter = $this->getEaster($year);

        $data[] = new Holiday($easter, "Ostermontag", $timezone);
        $data[0]->modify("+1 day");
        $data[] = new Holiday($easter, "Christi Himmelfahrt", $timezone);
        $data[1]->modify("+39 days");
        $data[] = new Holiday($easter, "Pfingstmontag", $timezone);
        $data[2]->modify("+50 days");
        $data[] = new Holiday($easter, "Fronleichnam", $timezone);
        $data[3]->modify("+60 days");

        $data[] = new Holiday("01.01." . $year, "Neujahrstag", $timezone);
        $data[] = new Holiday("06.01." . $year, "Heilige drei Könige", $timezone);
        $data[] = new Holiday("01.05." . $year, "Staatsfeiertag", $timezone);
        $data[] = new Holiday("15.08." . $year, "Mariä Himmelfahrt", $timezone);
        $data[] = new Holiday("26.10." . $year, "Nationalfeiertag", $timezone);
        $data[] = new Holiday("01.11." . $year, "Allerheiligen", $timezone);
        $data[] = new Holiday("08.12." . $year, "Mariä Empfängnis", $timezone);
        $data[] = new Holiday("25.12." . $year, "Weihnachten", $timezone);
        $data[] = new Holiday("26.12." . $year, "Stefanitag", $timezone);

        return $data;
    }

    protected function getSpecial($year)
    {
        $timezone = $this->timezone;

        /** @var Holiday[] $data */
        $data   = array();
        $easter = $this->getEaster($year);

        $data[] = new Holiday($easter, "Karfreitag", $timezone, Holiday::NOTABLE);
        $data[0]->modify("-2 days");

        $data[] = new Holiday($easter, "Pfingstsonntag", $timezone, Holiday::NOTABLE);
        $data[1]->modify("+49 days");

        $data[] = new Holiday("24.12." . $year, "Heilig Abend", $timezone, Holiday::NOTABLE, 0.5);
        $data[] = new Holiday("31.12." . $year, "Silvester", $timezone, Holiday::NOTABLE, 0.5);

        return $data;
    }
}
