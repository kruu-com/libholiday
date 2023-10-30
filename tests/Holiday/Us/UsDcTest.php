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

use Holiday\Us\UsDc;
use PHPUnit\Framework\TestCase;

class UsDcTest extends TestCase
{
    private ?UsDc $holiday = null;

    private ?\DateTimeZone $timezone = null;

    public function setUp(): void
    {
        $this->timezone = new \DateTimeZone('UTC');
        $this->holiday = new UsDc($this->timezone);
    }

    public function testInaugurationDayIsHoliday()
    {
        $inaugurationDate = new \DateTime('2009-01-20', $this->timezone);

        $this->assertEquals(true, count($this->holiday->isHoliday($inaugurationDate)) > 0, 'First Inauguration Barack Obama');

        $inaugurationDate = new \DateTime('2013-01-20', $this->timezone);

        $this->assertEquals(true, count($this->holiday->isHoliday($inaugurationDate)) > 0, 'Second Inauguration Barack Obama');

        $inaugurationDate = new \DateTime('2021-01-20', $this->timezone);

        $this->assertEquals(true, count($this->holiday->isHoliday($inaugurationDate)) > 0, 'Inauguration Joe Biden');
    }
}
