<?php

namespace Holiday\AT;

use Holiday\Holiday;

class AT3 extends AT
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);
        $data[] = new Holiday("15.11." . $year, "St. Leopold", $timezone);

        return $data;
    }
}