<?php

namespace Holiday\At;

use Holiday\Holiday;

class At5 extends At
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);
        $data[] = new Holiday("24.09." . $year, "St. Rupert", $timezone);

        return $data;
    }
}
