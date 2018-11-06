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
namespace Holiday\It;

use Holiday\Calculator;
use Holiday\Holiday;

class It extends Calculator
{
    /**
     * Get public holidays valid in states of Italy as well as special holidays not valid in states of Italy.
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
     * Get _public holidays_ only. Not in all states of Italy days from getSpecial() are public holidays.
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
        $easter = new \DateTimeImmutable($this->getEaster($year)->format('Y-m-d'));

        $data[] = new Holiday("01.01." . $year, "Neujahrstag", $timezone);

        $data[] = new Holiday($easter->modify("+1 day")->format('d.m.Y'), "Ostermontag", $timezone);

        $data[] = new Holiday("06.01." . $year, "Heilige drei Könige", $timezone);
        $data[] = new Holiday("25.04." . $year, "Tag der Befreiung Italiens", $timezone);
        $data[] = new Holiday("02.06." . $year, "Tag der Republik", $timezone);
        $data[] = new Holiday("15.08." . $year, "Mariä Himmelfahrt", $timezone);
        $data[] = new Holiday("01.11." . $year, "Allerheiligen", $timezone);
        $data[] = new Holiday("08.12." . $year, "Mariä empfängnis", $timezone);
        $data[] = new Holiday("25.12." . $year, "1. Weihnachtstag", $timezone);
        $data[] = new Holiday("26.12." . $year, "Stephanstag", $timezone);

        return $data;
    }

    protected function getSpecial($year)
    {
        $timezone = $this->timezone;

        /** @var Holiday[] $data */
        $data   = array();
        $easter = new \DateTimeImmutable($this->getEaster($year)->format('Y-m-d'));

        $data[] = new Holiday($easter->modify("+49 days")->format('d.m.Y'), "Pfingstsonntag", $timezone, Holiday::PARTIAL);
        $data[] = new Holiday($easter->format('d.m.Y'), "Ostersonntag", $timezone, Holiday::PARTIAL);

        return $data;
    }
}
