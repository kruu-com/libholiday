<?php

namespace Holiday\AT;

use Holiday\Holiday;

class AT8 extends AT
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);
        $data[] = new Holiday("19.03." . $year, "St. Josef", $timezone);

        return $data;
    }
}