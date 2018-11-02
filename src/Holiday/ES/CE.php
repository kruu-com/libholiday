<?php

namespace Holiday\ES;

use Holiday\Holiday;

class CE extends ES
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year));

        $data[] = new Holiday("13.06." . $year, "Ceuta-Tag", $timezone);
        $data[] = new Holiday("05.08." . $year, "Nuestra Senora de Africa", $timezone);
        $data[] = new Holiday("22.08." . $year, "Eid al-Adha", $timezone);
        $data[] = new Holiday("02.09." . $year, "Tag der unabhängigen Stadt Ceuta", $timezone);

        return $data;
    }
}
