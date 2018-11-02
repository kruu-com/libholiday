<?php

namespace Holiday\ES;

use Holiday\Holiday;

class NC extends ES
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year));

        $data[] = new Holiday("03.12." . $year, "Navarra-Tag", $timezone);

        return $data;
    }
}
