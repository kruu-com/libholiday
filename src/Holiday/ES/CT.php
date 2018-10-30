<?php

namespace Holiday\ES;

use Holiday\Holiday;

class CT extends ES
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year));

        $data[] = new Holiday("23.04." . $year, "St. Georg", $timezone);

        return $data;
    }
}
