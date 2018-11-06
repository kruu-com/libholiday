<?php

namespace Holiday\At;

use Holiday\Holiday;

class At9 extends At
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);
        $data[] = new Holiday("15.11." . $year, "St. Leopold", $timezone);

        return $data;
    }
}
