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
namespace Tests\Holiday\Be;
use DateTimeZone;
use Holiday;
use PHPUnit\Framework\TestCase;

class BeGerTest extends TestCase
{

    /**
     * @var \DateTimeZone
     */
    private $timezone = null;

    public function setUp(): void
    {
        $this->timezone = new DateTimeZone('UTC');
    }

    public function testBelgiumGermanCommunityDay()
    {
        $by       = new Holiday\Be\BeGer($this->timezone);
        $holidays = $by->between(
            new \DateTime("2017-11-15", $this->timezone),
            new \DateTime("2017-11-15", $this->timezone));

        $holiday = array_pop($holidays);
        $this->assertEquals("Tag der Deutschen Gemeinschaft", $holiday->name);
        $this->assertEquals("2017-11-15 00:00:00", $holiday->format("Y-m-d H:i:s"));
        $this->assertEquals("UTC", $holiday->getTimeZone()->getName());
    }
}