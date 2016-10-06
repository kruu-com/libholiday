<?php

namespace Holiday\Austria;

use Holiday\Holiday;

class Burgenland extends Austria
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);
        $data[] = new Holiday("11.11." . $year, "St. Martin", $timezone);

        return $data;
    }
}
