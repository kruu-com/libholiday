<?php

namespace Holiday\It;

use Holiday\Holiday;

class It34 extends It
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data = parent::getHolidays($year);

        $data[] = new Holiday("25.04." . $year, "St. Markus", $timezone, Holiday::SUB_REGIONAL);

        return $data;
    }
}
