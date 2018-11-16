<?php

namespace Holiday\Es;

use Holiday\Holiday;

class EsMd extends Es
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year)->format('Y-m-d'));

        $data[] = new Holiday("02.05." . $year, "Madrid Tag", $timezone);
        $data[] = new Holiday("15.05." . $year, "St. Isidor", $timezone);
        $data[] = new Holiday("25.07." . $year, "Jakobus der Ältere", $timezone);
        $data[] = new Holiday($easter->modify("-3 days")->format('d.m.Y'), "Gründonnerstag", $timezone);
        $data[] = new Holiday($easter->modify("+60 days")->format('d.m.Y'), "Fronleichnam", $timezone);

        return $data;
    }
}
