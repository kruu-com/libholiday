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
namespace Tests\Holiday\It;
use Holiday;
use PHPUnit\Framework\TestCase;

class ItTest extends TestCase
{

    /**
     * @var \DateTimeZone
     */
    private $timezone = null;

    public function setUp(): void
    {
        $this->timezone = new \DateTimeZone('UTC');
    }

    public function testItalyCalculations()
    {
        $start = new \DateTime("2012-01-01", $this->timezone);
        $end   = new \DateTime("2012-12-31", $this->timezone);

        $Italy = new Holiday\It\It($this->timezone);

        $this->assertCount(12, $Italy->between($start, $end));
        $days = $Italy->between($start, $end);

        $this->assertEquals(
            new Holiday\Holiday("25.4.2012", "Tag der Befreiung Italiens", $this->timezone),
            $days[3]);
        $this->assertEquals(
            new Holiday\Holiday("15.8.2012", "Mariä Himmelfahrt", $this->timezone),
            $days[5]);
    }

    public function testItalyBetween()
    {
        $Italy = new Holiday\It\It($this->timezone);
        $res = $Italy->between(
                new \DateTime("1.4.2012", $this->timezone),
                new \DateTime("30.4.2012", $this->timezone));
        $this->assertCount(3, $res);
        $this->assertContainsOnlyInstancesOf('Holiday\Holiday', $res);

        $mapped = array_values(
            array_map(function(\DateTime $dt) {
                return $dt->format("d.m.Y H:i");
            }, $res));

        $expected = array(
            '08.04.2012 00:00',
            '09.04.2012 00:00',
            '25.04.2012 00:00');

        sort($expected);
        sort($mapped);
        $this->assertEquals($expected, $mapped);

        $this->assertCount(12, $Italy->between(
            new \DateTime("1.5.2012", $this->timezone),
            new \DateTime("1.5.2013", $this->timezone)));

        $res = $Italy->between(
                new \DateTime("25.4.2012", $this->timezone),
                new \DateTime("26.4.2012", $this->timezone));

        $this->assertEquals(
            new Holiday\Holiday("25.4.2012", "Tag der Befreiung Italiens", $this->timezone),
            array_pop($res));
    }

    public function testBug() {
        $Italy      = new Holiday\It\It($this->timezone);
        $fail    = $Italy->between(
            new \DateTime("2011-06-01", $this->timezone),
            new \DateTime("2012-05-01", $this->timezone));
        $correct = $Italy->between(
            new \DateTime("2011-05-02", $this->timezone),
            new \DateTime("2012-05-01", $this->timezone));
        $this->assertNotEquals(15, count($fail));
        $this->assertNotEquals(15, count($correct));
        $this->assertEquals(12, count($fail));
    }
}
