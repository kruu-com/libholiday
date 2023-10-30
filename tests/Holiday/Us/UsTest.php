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
namespace Tests\Holiday\Us;

use Holiday\Us\Us;
use PHPUnit\Framework\TestCase;

class UsTest extends TestCase
{
    private ?Us $holiday = null;

    private ?\DateTimeZone $timezone = null;

    public function setUp(): void
    {
        $this->timezone = new \DateTimeZone('UTC');
        $this->holiday = new Us($this->timezone);
    }

    public function testIsHoliday()
    {
        $christmas = new \DateTime('2015-12-25', $this->timezone);
        $christmasEve = new \DateTime('2015-12-24', $this->timezone);
        $thanksgiving = new \DateTime('2015-11-26', $this->timezone);
        $thanksgivingAdamOrBlackFriday = new \DateTime('2015-11-27', $this->timezone);
        $newYears = new \DateTime('2015-01-01', $this->timezone);
        $independenceDay = new \DateTime('2015-07-04', $this->timezone);
        $martinLutherKingDay = new \DateTime('2015-01-19', $this->timezone);
        $presidentsDay = new \DateTime('2015-02-16', $this->timezone);
        $memorialDay = new \DateTime('2015-05-25', $this->timezone);
        $juneteenthDay = new \DateTime('2021-06-19', $this->timezone);
        $veteransDay = new \DateTime('2014-11-11', $this->timezone);
        $columbusDay = new \DateTime('2014-10-13', $this->timezone);

        $dummyDate = new \DateTime('2015-03-11', $this->timezone);

        $this->assertEquals(true, count($this->holiday->isHoliday($christmas)) > 0, 'Christmas');
        $this->assertEquals(true, count($this->holiday->isHoliday($christmasEve)) > 0, 'Christmas Eve');
        $this->assertEquals(true, count($this->holiday->isHoliday($thanksgiving)) > 0, 'Thanksgiving');
        $this->assertEquals(true, count($this->holiday->isHoliday($thanksgivingAdamOrBlackFriday)) > 0, 'Black Friday');
        $this->assertEquals(true, count($this->holiday->isHoliday($newYears)) > 0, 'New Years');
        $this->assertEquals(true, count($this->holiday->isHoliday($independenceDay)) > 0, 'Independence Day');
        $this->assertEquals(true, count($this->holiday->isHoliday($martinLutherKingDay)) > 0, 'MLK Day');
        $this->assertEquals(true, count($this->holiday->isHoliday($presidentsDay)) > 0, 'Presidents Day');
        $this->assertEquals(true, count($this->holiday->isHoliday($memorialDay)) > 0, 'Memorial Day');
        $this->assertEquals(true, count($this->holiday->isHoliday($juneteenthDay)) > 0, 'Juneteenth Day');
        $this->assertEquals(true, count($this->holiday->isHoliday($veteransDay)) > 0, 'Veterans Day');
        $this->assertEquals(true, count($this->holiday->isHoliday($columbusDay)) > 0, 'Columbus Day');
        $this->assertNotEquals(true, count($this->holiday->isHoliday($dummyDate)) > 0, 'Dummy Date Test');
    }

    public function testInaugurationIsNotAPublicHoliday()
    {
        // this date is not a public holiday in any state except Washington, DC
        $inaugurationDate = new \DateTime('2009-01-20', $this->timezone);
        $this->assertNotEquals(true, count($this->holiday->isHoliday($inaugurationDate)) > 0, 'First Inauguration Barack Obama');
    }

    public function testLabourDay()
    {
        $laborDayDate = new \DateTime('2014-09-01', $this->timezone);
        $this->assertEquals(true, count($this->holiday->isHoliday($laborDayDate)) > 0, 'Labor Day');

        $laborDayDate = new \DateTime('2023-09-04', $this->timezone);
        $this->assertEquals(true, count($this->holiday->isHoliday($laborDayDate)) > 0, 'Labour Day');
    }

    public function testFollowUpDayIsHoliday()
    {
        $newYears = new \DateTime('2023-01-01', $this->timezone);
        $newYearsFollowUp = new \DateTime('2023-01-02', $this->timezone);

        $this->assertEquals(true, count($this->holiday->isHoliday($newYears)) > 0, 'New Years Day');
        $this->assertEquals(true, count($this->holiday->isHoliday($newYearsFollowUp)) > 0, 'New Years Follow Up Day');
    }

    public function testPreviousDayIsHoliday()
    {
        $independenceDay = new \DateTime('2026-07-04', $this->timezone);
        $independenceDayPreviousDay = new \DateTime('2026-07-03', $this->timezone);

        $this->assertEquals(true, count($this->holiday->isHoliday($independenceDay)) > 0, 'Independence Day');
        $this->assertEquals(true, count($this->holiday->isHoliday($independenceDayPreviousDay)) > 0, 'Independence Day Previous');
    }
}
