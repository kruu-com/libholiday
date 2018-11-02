<?php

namespace Holiday\IT;

use Holiday\Holiday;

class IT25 extends IT
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $easter = parent::getEaster($year);

        $data[] = new Holiday("07.12." . $year, "St. Ambrosius", $timezone, Holiday::NOTABLE);

        return $data;
    }
}
