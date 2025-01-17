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
namespace Holiday\De;

use Holiday\Holiday;

class DeSl extends De
{
    protected function getHolidays(int $year): array
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable($this->getEaster($year)->format('Y-m-d'));

        $data[] = new Holiday($easter->modify("+60 days")->format('d.m.Y'), "Fronleichnam", $timezone);
        $data[] = new Holiday("15.8." . $year, "Mariä Himmelfahrt", $timezone);
        $data[] = new Holiday("1.11." . $year, "Allerheiligen", $timezone);

        return $data;
    }
}
