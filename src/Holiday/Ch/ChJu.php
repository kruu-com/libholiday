<?php

namespace Holiday\Ch;

use Holiday\Holiday;

class ChJu extends Ch
{
    protected function getHolidays(int $year): array
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year)->format('d.m.Y'));

        $data[] = new Holiday($easter->modify("-2 days")->format('d.m.Y'), "Karfreitag", $timezone);
        $data[] = new Holiday($easter->modify("+1 day")->format('d.m.Y'), "Ostermontag", $timezone);
        $data[] = new Holiday($easter->modify("+60 days")->format('d.m.Y'), "Fronleichnam", $timezone);

        $data[] = new Holiday("02.01." . $year, "Bertholdstag", $timezone);
        $data[] = new Holiday("01.05." . $year, "Tag der Arbeit", $timezone);
        $data[] = new Holiday("23.06." . $year, "Fest der Unabhängigkeit", $timezone);
        $data[] = new Holiday('15.08.' . $year, "Mariä Himmelfahrt", $timezone);
        $date = new \DateTimeImmutable('Third Sunday of September ' . $year);
        $data[] = new Holiday($date->format('d.m.Y'), "Eidgenössischer Dank-, Buss- und Bettag", $timezone);
        $data[] = new Holiday('01.11.' . $year, "Allerheiligen", $timezone);

        return $data;
    }
}
