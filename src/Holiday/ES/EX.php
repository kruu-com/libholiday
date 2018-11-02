<?php

namespace Holiday\ES;

use Holiday\Holiday;

class EX extends ES
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year));

        $data[] = new Holiday("08.09." . $year, "Extramadura-Tag", $timezone);

        return $data;
    }
}
