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

use Holiday\Holiday;

class GbEng extends Gb
{
    protected function getHolidays(int $year): array
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable($this->getEaster($year)->format('Y-m-d'));

        $date = new Holiday("01.01." . $year, "Neujahrstag", $timezone);
        if( parent::checkForWeekend( $date ) ) {
            $date = new Holiday(new \DateTime('first Monday of January '.$year, $timezone), "Neujahrstag", $timezone);
        }
        $data[] = $date;
        $data[] = new Holiday($easter->modify("+1 day")->format('d.m.Y'), "Ostermontag", $timezone);
        $data[] = new Holiday("last Monday of August " . $year, "August Bank Holiday", $timezone);

        return $data;
    }
}
