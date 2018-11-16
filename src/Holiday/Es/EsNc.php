<?php

namespace Holiday\Es;

use Holiday\Holiday;

class EsNc extends Es
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable($this->getEaster($year)->format('Y-m-d'));

        $data[] = new Holiday($easter->modify("-3 days")->format('d.m.Y'), "Gründonnerstag", $timezone);
        $data[] = new Holiday($easter->modify("+1 day")->format('d.m.Y'), "Ostermontag", $timezone);
        $data[] = new Holiday("25.07." . $year, "Jakobus der Ältere", $timezone);
        $data[] = new Holiday("03.12." . $year, "Navarra-Tag", $timezone);

        return $data;
    }
}
