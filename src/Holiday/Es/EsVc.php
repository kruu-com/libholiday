<?php

namespace Holiday\Es;

use Holiday\Holiday;

class EsVc extends Es
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable($this->getEaster($year)->format('Y-m-d'));

        $data[] = new Holiday("09.10." . $year, "Valencia-Tag", $timezone);
        $data[] = new Holiday($easter->modify("+1 day")->format('d.m.Y'), "Ostermontag", $timezone);

        return $data;
    }
}
