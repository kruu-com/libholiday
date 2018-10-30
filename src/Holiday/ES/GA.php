<?php

namespace Holiday\ES;

use Holiday\Holiday;

class GA extends ES
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year));

        $data[] = new Holiday("17.05." . $year, "Galicien-Tag", $timezone);

        return $data;
    }
}
