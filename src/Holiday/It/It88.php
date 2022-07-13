<?php

namespace Holiday\It;

class It88 extends It
{
    protected function getHolidays(int $year): array
    {
        $data = parent::getHolidays($year);

        return $data;
    }
}
