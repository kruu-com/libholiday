<?php

namespace Holiday\ES;

use Holiday\Holiday;

class VC extends ES
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year));

        $data[] = new Holiday("09.10." . $year, "Valencia-Tag", $timezone);

        return $data;
    }
}
