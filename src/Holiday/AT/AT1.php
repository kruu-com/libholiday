<?php

namespace Holiday\AT;

use Holiday\Holiday;

class AT1 extends AT
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);
        $data[] = new Holiday("11.11." . $year, "St. Martin", $timezone);

        return $data;
    }
}
