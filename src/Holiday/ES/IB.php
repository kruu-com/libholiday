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

        return $data;
    }
}
