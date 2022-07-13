<?php

namespace Holiday\Dk;

class Dk85 extends Dk
{
    protected function getHolidays(int $year): array
    {
        $data   = parent::getHolidays($year);

        return $data;
    }
}
