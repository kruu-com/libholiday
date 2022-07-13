<?php

namespace Holiday\At;

use Holiday\Holiday;

class At1 extends At
{
    protected function getHolidays(int $year): array
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);
        $data[] = new Holiday("11.11." . $year, "St. Martin", $timezone);

        return $data;
    }
}
