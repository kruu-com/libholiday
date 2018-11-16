<?php

namespace Holiday\At;

use Holiday\Holiday;

class At1 extends At
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);
        $data[] = new Holiday("11.11." . $year, "St. Martin", $timezone);

        return $data;
    }
}
