<?php

namespace Holiday\ES;

use Holiday\Holiday;

class ML extends ES
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year));

        $data[] = new Holiday("22.08." . $year, "Eid al-Adha", $timezone);
        $data[] = new Holiday("08.09." . $year, "Virgen de la Victoria", $timezone);
        $data[] = new Holiday("17.09." . $year, "Melila-Tag", $timezone);


        return $data;
    }
}
