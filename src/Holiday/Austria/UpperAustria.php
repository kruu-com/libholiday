<?php
namespace Holiday\Austria;

use Holiday\Holiday;

class UpperAustria extends Austria
{
    protected function getSpecial($year)
    {
        $timezone = $this->timezone;

        /** @var Holiday[] $data */
        $data   = parent::getSpecial($year);

        $data[] = new Holiday("04.05."  . $year, "St. Florian", $timezone, Holiday::NOTABLE);

        return $data;
    }

}
