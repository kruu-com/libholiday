<?php

namespace Holiday\It;

use Holiday\Holiday;

class It25 extends It
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data = parent::getHolidays($year);

        $data[] = new Holiday("07.12." . $year, "St. Ambrosius", $timezone, Holiday::SUB_REGIONAL);

        return $data;
    }
}
