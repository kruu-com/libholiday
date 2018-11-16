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

class PolandTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \DateTimeZone
     */
    private $timezone = null;

    public function setUp()
    {
        $this->timezone = new DateTimeZone('UTC');
    }

    public function testPolandCalculations()
    {
        $start = new \DateTime("2012-01-01", $this->timezone);
        $end   = new \DateTime("2012-12-31", $this->timezone);

        $Poland = new Holiday\Pl\Pl($this->timezone);

        $this->assertCount(15, $Poland->between($start, $end));
        $days = $Poland->between($start, $end);

        $this->assertEquals(
            new Holiday\Holiday("09.04.2012", "Ostermontag", $this->timezone),
            $days[1]);
        $this->assertEquals(
            new Holiday\Holiday("17.5.2012", "Christi Himmelfahrt", $this->timezone),
            $days[3]);
    }

    public function testPolandBetween()
    {
        $Poland = new Holiday\Pl\Pl($this->timezone);
        $res = $Poland->between(
                new \DateTime("1.4.2012", $this->timezone),
                new \DateTime("30.4.2012", $this->timezone));
        $this->assertCount(2, $res);
        $this->assertContainsOnlyInstancesOf('Holiday\Holiday', $res);

        $mapped = array_values(
            array_map(function(\DateTime $dt) {
                return $dt->format("d.m.Y H:i");
            }, $res));

        $expected = array(
            '08.04.2012 00:00',
            '09.04.2012 00:00');

        sort($expected);
        sort($mapped);
        $this->assertEquals($expected, $mapped);

        $this->assertCount(17, $Poland->between(
            new \DateTime("1.5.2012", $this->timezone),
            new \DateTime("1.5.2013", $this->timezone)));

        $res = $Poland->between(
            new \DateTime("1.5.2012", $this->timezone),
            new \DateTime("2.5.2012", $this->timezone));

        $this->assertEquals(
            new Holiday\Holiday("1.5.2012", "Tag der Arbeit", $this->timezone),
            array_pop($res));
    }

    public function testPolandPST() {
        $timezone = new \DateTimeZone("PST");
        $Poland = new Holiday\Pl\Pl($timezone);
        $res = $Poland->between(
                new \DateTime("1.5.2012", $timezone),
                new \DateTime("2.5.2012", $timezone));
        $this->assertEquals(
            new Holiday\Holiday("1.5.2012", "Tag der Arbeit", $timezone),
            array_pop($res));
    }

    public function testBug() {
        $Poland      = new Holiday\Pl\Pl($this->timezone);
        $fail    = $Poland->between(
            new \DateTime("2011-06-01", $this->timezone),
            new \DateTime("2012-05-01", $this->timezone));
        $correct = $Poland->between(
            new \DateTime("2011-05-02", $this->timezone),
            new \DateTime("2012-05-01", $this->timezone));
        $this->assertNotEquals(12, count($fail));
        $this->assertNotEquals(12, count($correct));
        $this->assertEquals(13, count($fail));
    }
}
