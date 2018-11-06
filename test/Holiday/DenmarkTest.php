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

class DenmarkTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \DateTimeZone
     */
    private $timezone = null;

    public function setUp()
    {
        $this->timezone = new DateTimeZone('UTC');
    }

    public function testDenmarkCalculations()
    {
        $start = new \DateTime("2012-01-01", $this->timezone);
        $end   = new \DateTime("2012-12-31", $this->timezone);

        $Denmark = new Holiday\Dk\Dk($this->timezone);

        $this->assertCount(11, $Denmark->between($start, $end));
        $days = $Denmark->between($start, $end);

        $this->assertEquals(
            new Holiday\Holiday("09.04.2012", "Ostermontag", $this->timezone),
            $days[3]);
        $this->assertEquals(
            new Holiday\Holiday("17.5.2012", "Christi Himmelfahrt", $this->timezone),
            $days[5]);
    }

    public function testDenmarkBetween()
    {
        $Denmark = new Holiday\Dk\Dk($this->timezone);
        $res = $Denmark->between(
                new \DateTime("1.4.2012", $this->timezone),
                new \DateTime("30.4.2012", $this->timezone));
        $this->assertCount(4, $res);
        $this->assertContainsOnlyInstancesOf('Holiday\Holiday', $res);

        $mapped = array_values(
            array_map(function(\DateTime $dt) {
                return $dt->format("d.m.Y H:i");
            }, $res));

        $expected = array(
            '05.04.2012 00:00',
            '06.04.2012 00:00',
            '08.04.2012 00:00',
            '09.04.2012 00:00');

        sort($expected);
        sort($mapped);
        $this->assertEquals($expected, $mapped);

        $this->assertCount(12, $Denmark->between(
            new \DateTime("1.5.2012", $this->timezone),
            new \DateTime("1.5.2013", $this->timezone)));

        $res = $Denmark->between(
                new \DateTime("5.4.2012", $this->timezone),
                new \DateTime("5.4.2012", $this->timezone));

        $this->assertEquals(
            new Holiday\Holiday("5.4.2012", "Gründonnerstag", $this->timezone),
            array_pop($res));
    }

    public function testDenmarkPST() {
        $timezone = new \DateTimeZone("PST");
        $Denmark = new Holiday\Dk\Dk($timezone);
        $res = $Denmark->between(
                new \DateTime("4.4.2012", $timezone),
                new \DateTime("5.4.2012", $timezone));
        $this->assertEquals(
            new Holiday\Holiday("5.4.2012", "Gründonnerstag", $timezone),
            array_pop($res));
    }

    public function testBug() {
        $Denmark      = new Holiday\Dk\Dk($this->timezone);
        $fail    = $Denmark->between(
            new \DateTime("2011-06-01", $this->timezone),
            new \DateTime("2012-05-01", $this->timezone));
        $correct = $Denmark->between(
            new \DateTime("2011-05-02", $this->timezone),
            new \DateTime("2012-05-01", $this->timezone));
        $this->assertNotEquals(12, count($fail));
        $this->assertNotEquals(12, count($correct));
        $this->assertEquals(10, count($fail));
    }
}
