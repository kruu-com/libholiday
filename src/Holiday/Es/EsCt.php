<?php

namespace Holiday\Es;

use Holiday\Holiday;

class EsCt extends Es
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year)->format('Y-m-d'));

        $data[] = new Holiday($easter->modify("+1 day")->format('d.m.Y'), "Ostermontag", $timezone);
        $data[] = new Holiday("23.04." . $year, "St. Georg", $timezone);
        $data[] = new Holiday($easter->modify("+50 days")->format('d.m.Y'), "Pfingstmontag", $timezone, Holiday::NOTABLE);
        $data[] = new Holiday("24.06." . $year, "Johannes der Täufer", $timezone);
        $data[] = new Holiday("11.09." . $year, "Katalonien-Tag", $timezone);
        $data[] = new Holiday("26.12." . $year, "San Esteban", $timezone, Holiday::NOTABLE);

        return $data;
    }
}
