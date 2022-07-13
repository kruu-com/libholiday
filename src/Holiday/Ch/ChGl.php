<?php

namespace Holiday\Ch;

use Holiday\Holiday;

class ChGl extends Ch
{
    protected function getHolidays(int $year): array
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year)->format('d.m.Y'));

        $data[] = new Holiday($easter->modify("-2 days")->format('d.m.Y'), "Karfreitag", $timezone);
        $data[] = new Holiday($easter->modify("+1 day")->format('d.m.Y'), "Ostermontag", $timezone);
        $data[] = new Holiday($easter->modify("+50 days")->format('d.m.Y'), "Pfingstmontag", $timezone);

        $date = new \DateTimeImmutable('first Thursday of April '.$year);
        $data[] = new Holiday($date->format('d.m.Y'), "Näfelser Fahrt", $timezone);
        $date = new \DateTimeImmutable('Third Sunday of September ' . $year);
        $data[] = new Holiday($date->format('d.m.Y'), "Eidgenössischer Dank-, Buss- und Bettag", $timezone);
        $data[] = new Holiday('01.11.' . $year, "Allerheiligen", $timezone);
        $data[] = new Holiday("26.12." . $year, "Stephanstag", $timezone);

        return $data;
    }
}
