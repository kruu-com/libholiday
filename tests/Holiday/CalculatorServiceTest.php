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
namespace Tests\Holiday;

use Holiday;
use Holiday\CalculatorService;
use PHPUnit\Framework\TestCase;

class CalculatorServiceTest extends TestCase
{

    /**
     * @var string
     */
    private $countryAT;

    /**
     * @var string
     */
    private $countryDE;

    /**
     * @var string
     */
    private $countryUs;

    /**
     * @var string
     */
    private $stateAT;

    /**
     * @var string
     */
    private $stateDE;

    /**
     * @var CalculatorService
     */
    protected $calculatorService;

    public function setUp(): void
    {
        $this->countryAT = 'At';
        $this->stateAT = 1;

        $this->countryDE = 'De';
        $this->stateDE = 'BY';

        $this->countryUs = 'Us';

        $this->calculatorService = new CalculatorService();
    }

    public function testCalculatorServiceForCountryAndStateCombinedCanBeLoaded() {
        $fixture = $this->calculatorService->getCalculatorByCountryAndState($this->countryAT, $this->stateAT);
        $this->assertInstanceOf(Holiday\At\At1::class, $fixture);
    }

    public function testCalculatorServiceForCountryCanBeLoaded() {
        $fixture = $this->calculatorService->getCalculatorByCountryAndState($this->countryAT);
        $this->assertInstanceOf(Holiday\At\At::class, $fixture);
    }

    public function testCalculatorServiceForCountryAndStateCanBeLoaded() {
        $fixture = $this->calculatorService->getCalculatorByCountryAndState($this->countryDE, $this->stateDE);
        $this->assertInstanceOf(Holiday\De\DeBy::class, $fixture);
    }

    public function testThrowsForNotImplementedCountry() {
        $this->expectException(Holiday\Exception\CalculatorException::class);
        $this->calculatorService->getCalculatorByCountryAndState('XX');
    }

    public function testCalculatorForStateNotAvailableExceptionHasUsHolidayCalculator() {
        try {
            $this->calculatorService->getCalculatorByCountryAndState($this->countryUs, 'XX');
        } catch (Holiday\Exception\CalculatorForStateNotAvailableException $e) {
            $this->assertInstanceOf(Holiday\Us\Us::class, $e->getCountryCalculator());
        }
    }
}
