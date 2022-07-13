<?php

namespace Holiday\At;

use Holiday\Holiday;

class At6 extends At
{
    protected function getHolidays(int $year): array
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);
        $data[] = new Holiday("19.03." . $year, "St. Josef", $timezone);

        return $data;
    }
}
