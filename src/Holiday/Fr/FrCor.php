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
namespace Holiday\Fr;

use Holiday\Holiday;

class FrCor extends Fr20r
{
    protected function getHolidays(int $year): array
    {
        // Please add new public holidays not in here. Use parent class Fr20r.php (see comment there why)

        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        return $data;
    }
}
