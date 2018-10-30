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
namespace Holiday\GB;

use Holiday\Holiday;

class SCT extends GB
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $date = new Holiday("01.01." . $year, "Neujahrstag", $timezone);
        if( parent::checkForWeekend( $date ) ) {
            $date = new Holiday(new \DateTime('first Tuesday of January '.$year, $timezone), "Neujahrstag", $timezone);
        }
        $data[] = $date;
        $date = new Holiday("02.01." . $year, "Neujahrstag", $timezone);
        if( parent::checkForWeekend( $date ) ) {
            $date = new Holiday(new \DateTime('first Monday of January '.$year, $timezone), "Neujahrstag", $timezone);
        }
        $data[] = $date;
        $data[] = new Holiday("first Monday in August " . $year, "August Bank Holiday", $timezone);

        return $data;
    }
}
