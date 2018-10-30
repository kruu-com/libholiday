<?php

namespace Holiday\ES;

use Holiday\Holiday;

class CN extends ES
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year));

        $data[] = new Holiday("30.05." . $year, "Tag der Kanaren", $timezone);

        return $data;
    }
}
