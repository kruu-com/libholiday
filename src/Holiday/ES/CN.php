<?php

namespace Holiday\ES;

use Holiday\Holiday;

class CN extends ES
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $data[] = new Holiday("30.05." . $year, "Tag der Kanaren", $timezone);
        $data[] = new Holiday("31.05." . $year, "Tag der Kanaren", $timezone, Holiday::NOTABLE);

        return $data;
    }
}
