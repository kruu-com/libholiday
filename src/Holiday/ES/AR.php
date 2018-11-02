<?php

namespace Holiday\ES;

use Holiday\Holiday;

class AR extends ES
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $data[] = new Holiday("23.04." . $year, "Aragon-Tag", $timezone);
        $data[] = new Holiday("29.01." . $year, "Fest des Hl. Valero", $timezone, Holiday::NOTABLE);
        $data[] = new Holiday("05.05." . $year, "Fünfter März", $timezone, Holiday::NOTABLE);


        return $data;
    }
}
