<?php

namespace Holiday\ES;

use Holiday\Holiday;

class CM extends ES
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year));

        $data[] = new Holiday("31.05." . $year, "Tag von Kastilien-La Mancha", $timezone);

        return $data;
    }
}
