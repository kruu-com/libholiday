<?php

namespace Holiday\ES;

use Holiday\Holiday;

class IB extends ES
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year));

        $data[] = new Holiday("01.03." . $year, "Tag der Balearen", $timezone);
        $data[] = new Holiday("26.12." . $year, "San Esteban", $timezone);

        return $data;
    }
}
