<?php
namespace Holiday\Austria;

use Holiday\Holiday;

class Tyrol extends Austria
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);
        $data[] = new Holiday("19.03." . $year, "St. Josef", $timezone);

        return $data;
    }
}
