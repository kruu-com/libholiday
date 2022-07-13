<?php

namespace Holiday\Es;

use Holiday\Holiday;

class EsAs extends Es
{
    protected function getHolidays(int $year): array
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $data[] = new Holiday("08.09." . $year, "Asturien-Tag", $timezone);

        return $data;
    }
}
