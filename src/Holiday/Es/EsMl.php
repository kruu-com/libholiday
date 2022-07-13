<?php

namespace Holiday\Es;

use Holiday\Holiday;

class EsMl extends Es
{
    protected function getHolidays(int $year): array
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable($this->getEaster($year)->format('Y-m-d'));

        $data[] = new Holiday("22.08." . $year, "Eid al-Adha", $timezone);
        $data[] = new Holiday("08.09." . $year, "Virgen de la Victoria", $timezone);
        $data[] = new Holiday("17.09." . $year, "Melilla-Tag", $timezone);
        $data[] = new Holiday($easter->modify("-3 days")->format('d.m.Y'), "Gründonnerstag", $timezone);


        return $data;
    }
}
