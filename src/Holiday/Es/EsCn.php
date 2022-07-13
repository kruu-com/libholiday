<?php

namespace Holiday\Es;

use Holiday\Holiday;

class EsCn extends Es
{
    protected function getHolidays(int $year): array
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable($this->getEaster($year)->format('Y-m-d'));

        $data[] = new Holiday("30.05." . $year, "Tag der Kanaren", $timezone);
        $data[] = new Holiday("31.05." . $year, "Tag der Kanaren", $timezone);
        $data[] = new Holiday("25.07." . $year, "Jakobus der Ältere", $timezone);
        $data[] = new Holiday($easter->modify("-3 days")->format('d.m.Y'), "Gründonnerstag", $timezone);

        return $data;
    }
}
