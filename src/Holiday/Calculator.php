<?php
/**
 * This software is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License version 3 as published by the Free Software Foundation
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * @copyright  Copyright (c) 2012 Mayflower GmbH (http://www.mayflower.de)
 * @license    LGPL v3 (See LICENSE file)
 */

namespace Holiday;

/**
 * Implements a template class for holiday calculation.
 *
 */
abstract class Calculator
{
    protected $timezone;

    public function __construct(\DateTimeZone $timezone = null)
    {
        $this->timezone = $timezone;
    }

    /**
     * The template method to be used in the between calculation.
     *
     * Returns an array of Holidays.
     *
     * @see between()
     *
     */
    abstract protected function getHolidays(int $year): array;

    /**
     * Provides a DateTime object that represents easter sunday for this year.
     *
     * The DateTime object is always set to the current default timezone and
     * not UTC and time is set 0:00.
     *
     * TODO: add timezone calculation
     */
    protected function getEaster(int $year): \DateTime
    {
        $easter = new \DateTime('now', $this->timezone);
        $easter->setDate($year, 3, 21);
        $easter->setTime(0, 0, 0);
        $easter->modify('+' . \easter_days($year) . 'days');
        return $easter;
    }

    /**
     * Returns all holidays in the given time period.
     */
    public function between(\DateTime $start, \DateTime $end): array
    {
        // Comparing DateTime also looks at the time. So we need to make sure the time is 0,
        // but don't modify the original referenced DateTime parameters
        $start = clone $start;
        $end = clone $end;
        $start->setTime(0, 0, 0);
        $end->setTime(0, 0, 0);

        $startyear = (int)$start->format("Y");
        $endyear = (int)$end->format("Y");
        $holidays = array();
        for ($y = $startyear; $y <= $endyear; $y++) {
            $holidays = array_merge($holidays, $this->getHolidays($y));
        }

        return array_filter($holidays,
            function(\DateTime $dt) use ($start, $end) {
                return $dt >= $start && $dt <= $end;
            });
    }

    public function isHoliday(\DateTime $date)
    {
        return $this->between($date, $date);
    }
}

