<?php

namespace Holiday\It;

use Holiday\Holiday;

class It42 extends It
{
    protected function getHolidays(int $year): array
    {
        $timezone = $this->timezone;

        $data = parent::getHolidays($year);

        $data[] = new Holiday("24.06." . $year, "Johannes der Täufer", $timezone, Holiday::SUB_REGIONAL);

        return $data;
    }
}
