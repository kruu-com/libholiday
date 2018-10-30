<?php

namespace Holiday\CH;

use Holiday\Holiday;

class GR extends CH
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year));

        $data[] = new Holiday($easter->modify("-2 days"), "Karfreitag", $timezone);
        $data[] = new Holiday($easter->modify("+1 day"), "Ostermontag", $timezone);
        $data[] = new Holiday($easter->modify("+50 days"), "Pfingstmontag", $timezone);

        $data[] = new Holiday("06.01." . $year, "Dreikönigsfest", $timezone);
        $data[] = new Holiday("19.03." . $year, "Josefstag", $timezone);
        $data[] = new Holiday("29.06." . $year, "Peter und Paul", $timezone);
        $data[] = new Holiday('15.08.' . $year, "Mariä Himmelfahrt", $timezone);
        $date = new \DateTimeImmutable('Third Sunday of September ' . $year);
        $data[] = new Holiday($date, "Eidgenössischer Dank-, Buss- und Bettag", $timezone);
        $data[] = new Holiday("26.12." . $year, "Stephanstag", $timezone);

        return $data;
    }
}
