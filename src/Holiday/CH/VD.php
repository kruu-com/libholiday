<?php

namespace Holiday\CH;

use Holiday\Holiday;

class VD extends CH
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year));

        $data[] = new Holiday($easter->modify("-2 days"), "Karfreitag", $timezone);
        $data[] = new Holiday($easter->modify("+50 days"), "Pfingstmontag", $timezone);

        $date = new \DateTimeImmutable('Third Sunday of September ' . $year);
        $data[] = new Holiday($date, "Eidgenössischer Dank-, Buss- und Bettag", $timezone);
        $data[] = new Holiday($date->modify("+1 day"), "Bettagsmontag", $timezone);
        $data[] = new Holiday("02.01." . $year, "Bertholdstag", $timezone);

        return $data;
    }
}
