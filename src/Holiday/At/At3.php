<?php

namespace Holiday\At;

use Holiday\Holiday;

class At3 extends At
{
    protected function getHolidays(int $year): array
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);
        $data[] = new Holiday("15.11." . $year, "St. Leopold", $timezone);

        return $data;
    }
}