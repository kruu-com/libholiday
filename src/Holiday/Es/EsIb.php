<?php

namespace Holiday\Es;

use Holiday\Holiday;

class EsIb extends Es
{
    protected function getHolidays(int $year): array
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable($this->getEaster($year)->format('Y-m-d'));

        $data[] = new Holiday("01.03." . $year, "Tag der Balearen", $timezone);
        $data[] = new Holiday($easter->modify("-3 days")->format('d.m.Y'), "Gründonnerstag", $timezone);
        $data[] = new Holiday("26.12." . $year, "San Esteban", $timezone);

        return $data;
    }
}
