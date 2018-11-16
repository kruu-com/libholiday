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
namespace Holiday\Test;
use DateTimeZone;
use Holiday;

class AustriaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \DateTimeZone
     */
    private $timezone = null;

    public function setUp()
    {
        $this->timezone = new DateTimeZone('UTC');
    }

    public function testAustriaCalculations()
    {
        $start = new \DateTime("2016-01-01", $this->timezone);
        $end   = new \DateTime("2016-12-31", $this->timezone);

        $austria = new Holiday\At\At($this->timezone);
        $this->assertCount(17, $austria->between($start, $end));

        $days = $austria->between($start, $end);

        $this->assertEquals(
            new Holiday\Holiday("28.3.2016", "Ostermontag", $this->timezone),
            $days[0]);

        $holidays = $austria->between(
            new \DateTime("2016-05-05", $this->timezone),
            new \DateTime("2016-05-05", $this->timezone));

        $holiday = array_pop($holidays);
        $this->assertEquals("Christi Himmelfahrt", $holiday->name);
        $this->assertEquals("2016-05-05 00:00:00", $holiday->format("Y-m-d H:i:s"));
    }
}
