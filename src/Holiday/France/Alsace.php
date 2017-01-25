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
namespace Holiday\France;

use Holiday\Holiday;

class Alsace extends France
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $easter = $this->getEaster($year);
        $data   = parent::getHolidays($year);
        $data[] = new Holiday($easter, "Karfreitag", $timezone);
        $data[0]->modify("-2 days");
        $data[] = new Holiday("26.12." . $year, "2. Weihnachtsfeiertag", $timezone);

        return $data;
    }
}
