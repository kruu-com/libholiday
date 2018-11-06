<?php

namespace Holiday\It;

use Holiday\Holiday;

class It72 extends It
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data = parent::getHolidays($year);

        $data[] = new Holiday("19.09." . $year, "St. Gennaro", $timezone, Holiday::SUB_REGIONAL);

        return $data;
    }
}
