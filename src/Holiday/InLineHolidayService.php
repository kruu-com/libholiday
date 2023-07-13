<?php

namespace Holiday;

class InLineHolidayService
{
    private static bool $isSaturday = false;
    private static bool $isSunday = false;

    public static function checkInLineHoliday(Holiday $holiday, array $holidays, InLineHolidayRules $rules): array
    {
        $holidays[] = $holiday;

        if ($rules->areRulesApplied()) {
            $date = clone $holiday;
            $holidayName = sprintf('%s (in line)', $holiday->name);
            if ($rules->isWeekday()) {
                if ($rules->isPreviousDay()) {
                    $holidays[] = new Holiday($date->modify('-1 days'), $holidayName, $holiday->getTimezone());
                }
                if ($rules->isFollowUpDay()) {
                    $holidays[] = new Holiday($date->modify('+1 days'), $holidayName, $holiday->getTimezone());
                }
            }

            if ($rules->isWeekend()) {
                self::checkForWeekend($holiday);

                if (self::$isSaturday && $rules->isPreviousDay()) {
                    $holidays[] = new Holiday($date->modify('-1 days'), $holidayName, $holiday->getTimezone());
                }
                if (self::$isSunday && $rules->isFollowUpDay()) {
                    $holidays[] = new Holiday($date->modify('+1 days'), $holidayName, $holiday->getTimezone());
                }
            }
        }

        return $holidays;
    }
    private static function checkForWeekend($time): void
    {
        $weekday = $time->format('N');
        switch ($weekday) {
            case 6:
                self::$isSaturday = true;
                break;
            case 7:
                self::$isSunday = true;
                break;
        }
    }
}
