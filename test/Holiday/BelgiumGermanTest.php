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

class BelgiumGermanTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \DateTimeZone
     */
    private $timezone = null;

    public function setUp()
    {
        $this->timezone = new DateTimeZone('UTC');
    }

    public function testBelgiumGermanCommunityDay()
    {
        $utc      = new \DateTimeZone("UTC");
        $by       = new Holiday\BE\GER($utc);
        $holidays = $by->between(
            new \DateTime("2017-11-15", $utc),
            new \DateTime("2017-11-15", $utc));

        $holiday = array_pop($holidays);
        $this->assertEquals("Tag der Deutschen Gemeinschaft", $holiday->name);
        $this->assertEquals("2017-11-15 00:00:00", $holiday->format("Y-m-d H:i:s"));
        $this->assertEquals("UTC", $holiday->getTimeZone()->getName());
    }
}