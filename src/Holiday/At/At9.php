<?php

namespace Holiday\At;

use Holiday\Holiday;

class At9 extends At
{
    protected function getHolidays(int $year): array
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);
        $data[] = new Holiday("15.11." . $year, "St. Leopold", $timezone);

        return $data;
    }
}
