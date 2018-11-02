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

class FranceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \DateTimeZone
     */
    private $timezone = null;

    public function setUp()
    {
        $this->timezone = new DateTimeZone('UTC');
    }

    public function testFranceCalculations()
    {
        $start = new \DateTime("2012-01-01", $this->timezone);
        $end   = new \DateTime("2012-12-31", $this->timezone);

        $France = new Holiday\FR\FR($this->timezone);

        $days = $France->between($start, $end);
        $this->assertCount(16, $days);
        $this->assertEquals(
            new Holiday\Holiday("9.4.2012", "Ostermontag", $this->timezone),
            $days[0]);
        $this->assertEquals(
            new Holiday\Holiday("17.5.2012", "Christi Himmelfahrt", $this->timezone),
            $days[1]);
    }

    public function testFranceBetween()
    {
        $France = new Holiday\FR\FR($this->timezone);
        $res = $France->between(
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

        $this->assertCount(17, $France->between(
            new \DateTime("1.5.2012", $this->timezone),
            new \DateTime("1.5.2013", $this->timezone)));

        $res = $France->between(
                new \DateTime("1.5.2012", $this->timezone),
                new \DateTime("1.5.2012", $this->timezone));

        $this->assertEquals(
            new Holiday\Holiday("01.05.2012", "Tag der Arbeit", $this->timezone),
            array_pop($res));
    }

    public function testFrancePST() {
        $timezone = new \DateTimeZone("PST");
        $France = new Holiday\FR\FR($timezone);
        $res = $France->between(
                new \DateTime("1.5.2012", $timezone),
                new \DateTime("2.5.2012", $timezone));
        $this->assertEquals(
            new Holiday\Holiday("1.5.2012", "Tag der Arbeit", $timezone),
            array_pop($res));
    }

    public function testWeights() {
        $France       = new Holiday\FR\FR($this->timezone);
        $holidays = $France->between(
            new \DateTime("2012-12-24", $this->timezone),
            new \DateTime("2012-12-24", $this->timezone));
        $holiday  = array_pop($holidays);
        $this->assertEquals(0.5, $holiday->weight, 'Heilig Abend weight', 0.001);
    }

    public function testBug() {
        $France      = new Holiday\FR\GES($this->timezone);
        $fail    = $France->between(
            new \DateTime("2011-06-01", $this->timezone),
            new \DateTime("2012-05-01", $this->timezone));
        $correct = $France->between(
            new \DateTime("2011-05-02", $this->timezone),
            new \DateTime("2012-05-01", $this->timezone));
        $this->assertNotEquals(12, count($fail));
        $this->assertNotEquals(12, count($correct));
        $this->assertEquals(17, count($fail));
    }
}
