<?php

namespace Holiday\Dk;

class Dk82 extends Dk
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        return $data;
    }
}
