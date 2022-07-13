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
namespace Holiday\Gb;

use Holiday\Calculator;
use Holiday\Holiday;

class Gb extends Calculator
{
    /**
     * Get public holidays valid in states of United Kingdom as well as special holidays not valid in states of United Kingdom.
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
     * Get _public holidays_ only. Not in all states of United Kingdom days from getSpecial() are public holidays.
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
        $data[] = new Holiday($easter->modify("-2 days")->format('d.m.Y'), "Karfreitag", $timezone);
        $data[] = new Holiday("first Monday of May " . $year, "Early May Bank Holiday", $timezone);
        $data[] = new Holiday("last Monday of May " . $year, "Spring Bank Holiday", $timezone);
        $date = new Holiday("25.12." . $year, "1. Weihnachtsfeiertag", $timezone);
        if( $this->checkForWeekend($date) ) {
            $date->modify("next tuesday");
        }
        $date = new Holiday("26.12." . $year, "2. Weihnachtsfeiertag", $timezone);
        if( $this->checkForWeekend($date) ) {
            $date->modify("next monday");
        }


        $data[] = $date;

        return $data;
    }

    private function getSpecial($year)
    {
        $timezone = $this->timezone;

        /** @var Holiday[] $data */
        $data   = array();
        $easter = new \DateTimeImmutable($this->getEaster($year)->format('Y-m-d'));
        $data[] = new Holiday($easter->format('d.m.Y'), "Ostersonntag", $timezone, Holiday::NOTABLE);
        $data[] = new Holiday("24.12." . $year, "Heilig Abend", $timezone, Holiday::NOTABLE, 0.5);
        $data[] = new Holiday("31.12." . $year, "Silvester", $timezone, Holiday::NOTABLE, 0.5);

        return $data;
    }

    protected function checkForWeekend($date)
    {
        if( $date->format('N') > 5) {
            return true;
        } else {
            return false;
        }
    }
}
