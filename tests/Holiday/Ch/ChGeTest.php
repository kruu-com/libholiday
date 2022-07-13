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
namespace Tests\Holiday\Ch;
use DateTimeZone;
use Holiday;
use PHPUnit\Framework\TestCase;

class ChGeTest extends TestCase
{
    /**
     * @var \DateTimeZone
     */
    private $timezone = null;

    public function setUp(): void
    {
        $this->timezone = new DateTimeZone('UTC');
    }

    public function testEasterBug() {
        $utc      = new \DateTimeZone("UTC");
        $by       = new Holiday\Ch\ChGe($utc);
        $holidays = $by->between(
            new \DateTime("2012-04-09", $utc),
            new \DateTime("2012-04-09", $utc));

        $holiday = array_pop($holidays);
        $this->assertEquals("Ostermontag", $holiday->name);
        $this->assertEquals("2012-04-09 00:00:00", $holiday->format("Y-m-d H:i:s"));
        $this->assertEquals("UTC", $holiday->getTimeZone()->getName());
    }

    public function testBug() {
        $de      = new Holiday\Ch\ChGe($this->timezone);
        $fail    = $de->between(
            new \DateTime("2011-06-01", $this->timezone),
            new \DateTime("2012-05-01", $this->timezone));
        $correct = $de->between(
            new \DateTime("2011-05-02", $this->timezone),
            new \DateTime("2012-05-01", $this->timezone));
        $this->assertNotEquals(12, count($fail));
        $this->assertNotEquals(12, count($correct));
        $this->assertEquals(10, count($fail));
    }
}
