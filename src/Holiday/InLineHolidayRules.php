<?php

namespace Holiday;

class InLineHolidayRules
{
    private bool $weekend;
    private bool $weekday;
    private bool $followUpDay;
    private bool $previousDay;

    public function __construct(bool $weekend = false, bool $weekday = false, bool $followUpDay = false, bool $previousDay = false)
    {
        $this->weekend = $weekend;
        $this->weekday = $weekday;
        $this->followUpDay = $followUpDay;
        $this->previousDay = $previousDay;
    }

    /**
     * @return bool
     */
    public function isWeekend(): bool
    {
        return $this->weekend;
    }

    /**
     * @return bool
     */
    public function isWeekday(): bool
    {
        return $this->weekday;
    }

    /**
     * @return bool
     */
    public function isFollowUpDay(): bool
    {
        return $this->followUpDay;
    }

    /**
     * @return bool
     */
    public function isPreviousDay(): bool
    {
        return $this->previousDay;
    }

    public function areRulesApplied(): bool
    {
        return $this->weekend || $this->weekday || $this->previousDay || $this->followUpDay;
    }
}
