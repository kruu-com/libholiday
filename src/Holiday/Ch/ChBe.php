<?php

namespace Holiday\Ch;

use Holiday\Holiday;

class ChBe extends Ch
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year)->format('d.m.Y'));

        $data[] = new Holiday($easter->modify("-2 days")->format('d.m.Y'), "Karfreitag", $timezone);
        $data[] = new Holiday($easter->modify("+1 day")->format('d.m.Y'), "Ostermontag", $timezone);
        $data[] = new Holiday($easter->modify("+50 days")->format('d.m.Y'), "Pfingstmontag", $timezone);

        $data[] = new Holiday("02.01." . $year, "Bertholdstag", $timezone);
        $date = new \DateTimeImmutable('Third Sunday of September ' . $year);
        $data[] = new Holiday($date->format('d.m.Y'), "Eidgenössischer Dank-, Buss- und Bettag", $timezone);
        $data[] = new Holiday("26.12." . $year, "Stephanstag", $timezone);


        return $data;
    }
}
