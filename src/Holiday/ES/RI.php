<?php

namespace Holiday\ES;

use Holiday\Holiday;

class RI extends ES
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year));

        $data[] = new Holiday("09.06." . $year, "La Rioja-Tag", $timezone);

        return $data;
    }
}
