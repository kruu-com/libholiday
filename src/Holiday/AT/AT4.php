<?php

namespace Holiday\AT;

use Holiday\Holiday;

class AT4 extends AT
{
    protected function getSpecial($year)
    {
        $timezone = $this->timezone;

        /** @var Holiday[] $data */
        $data   = parent::getHolidays($year);

        $data[] = new Holiday("04.05."  . $year, "St. Florian", $timezone, Holiday::NOTABLE);

        return $data;
    }

}
