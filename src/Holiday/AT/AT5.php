<?php

namespace Holiday\AT;

use Holiday\Holiday;

class AT5 extends AT
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);
        $data[] = new Holiday("24.09." . $year, "St. Rupert", $timezone);

        return $data;
    }
}
