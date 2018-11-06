<?php

namespace Holiday\At;

use Holiday\Holiday;

class At2 extends At
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);
        $data[] = new Holiday("19.03." . $year, "St. Josef", $timezone);
        $data[] = new Holiday("10.10." . $year, "Tag der Volksabstimmung", $timezone);

        return $data;
    }
}
