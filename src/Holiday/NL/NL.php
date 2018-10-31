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
 * @copyright  Copyright (c) 2014 Galo Arends
 * @license    LGPL v3 (See LICENSE file)
 */

namespace Holiday\NL;

use Holiday\Calculator;
use Holiday\Holiday;

class NL extends Calculator
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = array();

        $easter = new \DateTimeImmutable($this->getEaster($year)->format('Y-m-d'));

        $data[] = new Holiday($easter->modify("+1 day"), "2de paasdag", $timezone);
        $data[] = new Holiday($easter->modify("+39 days"), "Hemelvaartsdag", $timezone);
        $data[] = new Holiday($easter->modify("+50 days"), "2de pinksterdag", $timezone);
        $data[] = new Holiday("01.01." . $year, "Nieuwjaarsdag", $timezone);

        if($year < 2014) {
            $royal = new Holiday("30.04." . $year, "Koninginnedag", $timezone);
        } else {
            $royal = new Holiday("27.04." . $year, "Koningsdag", $timezone);
        }
        if ($royal->format('N') == 7) {
            $royal->modify('-1 day');
        }
        if ($year % 5 == 0) {
            $data[] = new Holiday("05.05." . $year, "Bevrijdingsdag", $timezone);
        }
        $data[] = $royal;

        $data[] = new Holiday("25.12." . $year, "1ste kerstdag", $timezone);
        $data[] = new Holiday("26.12." . $year, "2de kerstdag", $timezone);


        return array_merge($data, $this->getSpecial($year));
    }
    
    private function getSpecial($year)
    {
        $timezone = $this->timezone;

        $data   = array();

        $easter = new \DateTimeImmutable($this->getEaster($year)->format('Y-m-d'));

        $data[] = new Holiday($easter->modify('-2 days'), "Goede vrijdag", $timezone, Holiday::NOTABLE);
        $data[] = new Holiday($easter, "1ste paasdag", $timezone, Holiday::NOTABLE);
        $data[] = new Holiday($easter->modify("+49 days"), "1ste pinksterdag", $timezone, Holiday::NOTABLE);
        $data[] = new Holiday("01.05." . $year, "Dag van de Arbeid", $timezone, Holiday::NOTABLE);

        if ($year % 5 > 0) {
            $data[] = new Holiday("05.05." . $year, "Bevrijdingsdag", $timezone, Holiday::NOTABLE);
        }

        $data[] = new Holiday("24.12." . $year, "Kerstavond", $timezone, Holiday::NOTABLE, 0.5);
        $data[] = new Holiday("31.12." . $year, "Oudejaarsavond", $timezone, Holiday::NOTABLE, 0.5);

        return $data;
    }
}
