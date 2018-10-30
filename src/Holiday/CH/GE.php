<?php

namespace Holiday\CH;

use Holiday\Holiday;

class GE extends CH
{
    protected function getHolidays($year)
    {
        $timezone = $this->timezone;

        $data   = parent::getHolidays($year);

        $easter = new \DateTimeImmutable(parent::getEaster($year));

        $data[] = new Holiday($easter->modify("-2 days"), "Karfreitag", $timezone);
        $data[] = new Holiday($easter->modify("+1 day"), "Ostermontag", $timezone);
        $data[] = new Holiday($easter->modify("+50 days"), "Pfingstmontag", $timezone);

        $genevanFast = new \DateTimeImmutable('First Sunday of September '.$year);
        $data[] = new Holiday($genevanFast->modify('+4 days'), "Jeûne genevois", $timezone);
        $data[] = new Holiday('31.12.'.$year, "Wiederherstellung der Republik", $timezone);

        return $data;
    }
}
