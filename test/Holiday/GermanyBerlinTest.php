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

class GermanyBerlinTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \DateTimeZone
     */
    private $timezone = null;

    public function setUp()
    {
        $this->timezone = new DateTimeZone('UTC');
    }

    public function testGermanyCalculations()
    {
        $start = new \DateTime("2012-01-01", $this->timezone);
        $end   = new \DateTime("2012-12-31", $this->timezone);

        $de = new Holiday\De\De($this->timezone);

        $this->assertCount(19, $de->between($start, $end));
        $days = $de->between($start, $end);
        $this->assertEquals(
            new Holiday\Holiday("6.4.2012", "Karfreitag", $this->timezone),
            $days[0]);
        $this->assertEquals(
            new Holiday\Holiday("9.4.2012", "Ostermontag", $this->timezone),
            $days[1]);
    }

    public function testGermanyBerlinBetween()
    {
        $deBe = new Holiday\De\DeBe($this->timezone);
        $res = $deBe->between(
            new \DateTime("1.3.2012", $this->timezone),
            new \DateTime("10.3.2012", $this->timezone)
        );
        $this->assertCount(1, $res);
        $this->assertContainsOnlyInstancesOf('Holiday\Holiday', $res);

        $mapped = array_values(
            array_map(
                function (\DateTime $dt) {
                    return $dt->format("d.m.Y H:i");
                },
                $res
            )
        );

        $expected = array(
            '08.03.2012 00:00'
        );

        $this->assertEquals($expected, $mapped);
    }
}
