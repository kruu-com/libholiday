<?php

namespace Holiday\Austria;

use Holiday\Holiday;

class Salzburg extends Austria
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);
        $data[] = new Holiday("24.09." . $year, "St. Rupert", $timezone);

        return $data;
    }
}
