<?php

namespace Tollwerk\TwCoderdojo\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Joschi Kuphal <joschi@tollwerk.de>, tollwerk GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class \Tollwerk\TwCoderdojo\Domain\Model\Location.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Joschi Kuphal <joschi@tollwerk.de>
 */
class LocationTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Tollwerk\TwCoderdojo\Domain\Model\Location
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \Tollwerk\TwCoderdojo\Domain\Model\Location();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getName()
		);
	}

	/**
	 * @test
	 */
	public function setNameForStringSetsName() {
		$this->subject->setName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'name',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getStreetAddressReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getStreetAddress()
		);
	}

	/**
	 * @test
	 */
	public function setStreetAddressForStringSetsStreetAddress() {
		$this->subject->setStreetAddress('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'streetAddress',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPostalCodeReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPostalCode()
		);
	}

	/**
	 * @test
	 */
	public function setPostalCodeForStringSetsPostalCode() {
		$this->subject->setPostalCode('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'postalCode',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLocalityReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLocality()
		);
	}

	/**
	 * @test
	 */
	public function setLocalityForStringSetsLocality() {
		$this->subject->setLocality('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'locality',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLatitudeReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getLatitude()
		);
	}

	/**
	 * @test
	 */
	public function setLatitudeForFloatSetsLatitude() {
		$this->subject->setLatitude(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'latitude',
			$this->subject,
			'',
			0.000000001
		);
	}

	/**
	 * @test
	 */
	public function getLongitudeReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getLongitude()
		);
	}

	/**
	 * @test
	 */
	public function setLongitudeForFloatSetsLongitude() {
		$this->subject->setLongitude(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'longitude',
			$this->subject,
			'',
			0.000000001
		);
	}

	/**
	 * @test
	 */
	public function getCountryReturnsInitialValueForCountry() {	}

	/**
	 * @test
	 */
	public function setCountryForCountrySetsCountry() {	}
}
