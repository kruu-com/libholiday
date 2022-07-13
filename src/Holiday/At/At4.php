<?php

namespace Holiday\At;

use Holiday\Holiday;

class At4 extends At
{
    protected function getHolidays(int $year): array
    {
        $timezone = $this->timezone;

        /** @var Holiday[] $data */
        $data   = parent::getHolidays($year);

        $data[] = new Holiday("04.05."  . $year, "St. Florian", $timezone, Holiday::NOTABLE);

        return $data;
    }

}
