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

class UsDc extends Us
{
    protected function getPublicHolidays($year)
    {
        $holidays = parent::getHolidays($year);

        $firstInaugurationYear = 1789;
        if (($year-$firstInaugurationYear) % 4 === 0) {
            $holidays[] = new Holiday($year.'-1-20', "Inauguration Day", $this->timezone);
        }

        return $holidays;
    }
}
