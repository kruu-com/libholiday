<?php

namespace Holiday\IT;

use Holiday\Holiday;

class IT34 extends IT
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $easter = parent::getEaster($year);
        $data[] = new Holiday("11.11." . $year, "St. Martin", $timezone);

        return $data;
    }
}
