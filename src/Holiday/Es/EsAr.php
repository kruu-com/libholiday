<?php

namespace Holiday\Es;

use Holiday\Holiday;

class EsAr extends Es
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable($this->getEaster($year)->format('Y-m-d'));

        $data[] = new Holiday("23.04." . $year, "Aragon-Tag", $timezone);
        $data[] = new Holiday($easter->modify("-3 days")->format('d.m.Y'), "Gründonnerstag", $timezone);
        $data[] = new Holiday("29.01." . $year, "Fest des Hl. Valero", $timezone, Holiday::SUB_REGIONAL);
        $data[] = new Holiday("05.05." . $year, "Fünfter März", $timezone, Holiday::SUB_REGIONAL);


        return $data;
    }
}
