<?php

namespace Holiday\Es;

use Holiday\Holiday;

class EsCm extends Es
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable($this->getEaster($year)->format('Y-m-d'));

        $data[] = new Holiday("31.05." . $year, "Tag von Kastilien-La Mancha", $timezone);
        $data[] = new Holiday($easter->modify("-3 days")->format('d.m.Y'), "Gründonnerstag", $timezone);

        return $data;
    }
}
