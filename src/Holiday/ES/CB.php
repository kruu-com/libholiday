<?php

namespace Holiday\ES;

use Holiday\Holiday;

class CB extends ES
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year));

        $data[] = new Holiday("28.07." . $year, "Tag der Institutionen", $timezone);
        $data[] = new Holiday("12.08." . $year, "Kantabrien-Tag", $timezone);
        $data[] = new Holiday("15.09." . $year, "Nuestra Senora de la Bien Aparecida", $timezone);

        return $data;
    }
}
