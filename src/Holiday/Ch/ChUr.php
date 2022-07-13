<?php

namespace Holiday\Ch;

use Holiday\Holiday;

class ChUr extends Ch
{
    protected function getHolidays(int $year): array
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year)->format('d.m.Y'));

        $data[] = new Holiday($easter->modify("-2 days"), "Karfreitag", $timezone);
        $data[] = new Holiday($easter->modify("+50 days"), "Pfingstmontag", $timezone);
        $data[] = new Holiday($easter->modify("+60 days"), "Fronleichnam", $timezone);

        $data[] = new Holiday("06.01." . $year, "Dreikönigsfest", $timezone);
        $data[] = new Holiday("19.03." . $year, "Josefstag", $timezone);
        $data[] = new Holiday('15.08.' . $year, "Mariä Himmelfahrt", $timezone);
        $date = new \DateTimeImmutable('Third Sunday of September ' . $year);
        $data[] = new Holiday($date->format('d.m.Y'), "Eidgenössischer Dank-, Buss- und Bettag", $timezone);
        $data[] = new Holiday('01.11.' . $year, "Allerheiligen", $timezone);
        $data[] = new Holiday('08.12.' . $year, "Mariä Empfängnis", $timezone);
        $data[] = new Holiday("26.12." . $year, "Stephanstag", $timezone);

        return $data;
    }
}
