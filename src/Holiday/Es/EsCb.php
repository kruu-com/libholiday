<?php

namespace Holiday\Es;

use Holiday\Holiday;

class EsCb extends Es
{
    protected function getHolidays(int $year): array
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable($this->getEaster($year)->format('Y-m-d'));

        $data[] = new Holiday($easter->modify("+1 day")->format('d.m.Y'), "Ostermontag", $timezone);
        $data[] = new Holiday("28.07." . $year, "Tag der Institutionen", $timezone);
        $data[] = new Holiday("12.08." . $year, "Kantabrien-Tag", $timezone);
        $data[] = new Holiday("15.09." . $year, "Nuestra Senora de la Bien Aparecida", $timezone);

        return $data;
    }
}
