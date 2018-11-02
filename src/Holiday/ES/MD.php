<?php

namespace Holiday\ES;

use Holiday\Holiday;

class MD extends ES
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year)->format('Y-m-d'));

        $data[] = new Holiday("02.05." . $year, "Madrid Tag", $timezone, Holiday::NOTABLE);
        $data[] = new Holiday("15.05." . $year, "St. Isidor", $timezone, Holiday::NOTABLE);

        $data[] = new Holiday($easter->modify("+60 days")->format('d.m.Y'), "Fronleichnam", $timezone, Holiday::NOTABLE);

        return $data;
    }
}
