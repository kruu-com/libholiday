<?php

namespace Holiday\Es;

use Holiday\Holiday;

class EsCe extends Es
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable($this->getEaster($year)->format('Y-m-d'));

        $data[] = new Holiday($easter->modify("-3 days")->format('d.m.Y'), "Gründonnerstag", $timezone);
        $data[] = new Holiday("13.06." . $year, "Ceuta-Tag", $timezone);
        $data[] = new Holiday("05.08." . $year, "Nuestra Senora de Africa", $timezone);
        $data[] = new Holiday("22.08." . $year, "Eid al-Adha", $timezone);
        $data[] = new Holiday("02.09." . $year, "Tag der unabhängigen Stadt Ceuta", $timezone);

        return $data;
    }
}
