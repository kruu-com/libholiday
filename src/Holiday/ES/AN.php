<?php

namespace Holiday\ES;

use Holiday\Holiday;

class AN extends ES
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year));

        $data[] = new Holiday("28.02." . $year, "Andalusien-Tag", $timezone);

        return $data;
    }
}
