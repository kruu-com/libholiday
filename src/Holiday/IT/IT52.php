<?php

namespace Holiday\IT;

use Holiday\Holiday;

class IT52 extends IT
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $easter = parent::getEaster($year);

        $data[] = new Holiday("24.06." . $year, "Johannes der Täufer", $timezone, Holiday::NOTABLE);

        return $data;
    }
}
