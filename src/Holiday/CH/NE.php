<?php

namespace Holiday\CH;

use Holiday\Holiday;

class NE extends CH
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year));

        $data[] = new Holiday($easter->modify("-2 days"), "Karfreitag", $timezone);
        $data[] = new Holiday($easter->modify("+60 days"), "Fronleichnam", $timezone);

        $data[] = new Holiday("02.01." . $year, "Bertholdstag", $timezone);
        $data[] = new Holiday("01.03." . $year, "Ausrufung der Republik", $timezone);
        $date = new \DateTimeImmutable('Third Sunday of September ' . $year);
        $data[] = new Holiday($date, "Eidgenössischer Dank-, Buss- und Bettag", $timezone);
        $data[] = new Holiday("26.12." . $year, "Stephanstag", $timezone);

        return $data;
    }
}
