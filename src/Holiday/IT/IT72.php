<?php

namespace Holiday\IT;

use Holiday\Holiday;

class IT72 extends IT
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $easter = parent::getEaster($year);

        $data[] = new Holiday("19.09." . $year, "St. Gennaro", $timezone, Holiday::NOTABLE);

        return $data;
    }
}
