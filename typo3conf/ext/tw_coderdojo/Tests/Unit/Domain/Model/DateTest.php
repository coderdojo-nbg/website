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
 * Test case for class \Tollwerk\TwCoderdojo\Domain\Model\Date.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Joschi Kuphal <joschi@tollwerk.de>
 */
class DateTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Tollwerk\TwCoderdojo\Domain\Model\Date
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \Tollwerk\TwCoderdojo\Domain\Model\Date();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getStartReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getStart()
		);
	}

	/**
	 * @test
	 */
	public function setStartForDateTimeSetsStart() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setStart($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'start',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEndReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getEnd()
		);
	}

	/**
	 * @test
	 */
	public function setEndForDateTimeSetsEnd() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setEnd($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'end',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLocationReturnsInitialValueForLocation() {
		$this->assertEquals(
			NULL,
			$this->subject->getLocation()
		);
	}

	/**
	 * @test
	 */
	public function setLocationForLocationSetsLocation() {
		$locationFixture = new \Tollwerk\TwCoderdojo\Domain\Model\Location();
		$this->subject->setLocation($locationFixture);

		$this->assertAttributeEquals(
			$locationFixture,
			'location',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMentorsReturnsInitialValueForPerson() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getMentors()
		);
	}

	/**
	 * @test
	 */
	public function setMentorsForObjectStorageContainingPersonSetsMentors() {
		$mentor = new \Tollwerk\TwCoderdojo\Domain\Model\Person();
		$objectStorageHoldingExactlyOneMentors = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneMentors->attach($mentor);
		$this->subject->setMentors($objectStorageHoldingExactlyOneMentors);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneMentors,
			'mentors',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addMentorToObjectStorageHoldingMentors() {
		$mentor = new \Tollwerk\TwCoderdojo\Domain\Model\Person();
		$mentorsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$mentorsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($mentor));
		$this->inject($this->subject, 'mentors', $mentorsObjectStorageMock);

		$this->subject->addMentor($mentor);
	}

	/**
	 * @test
	 */
	public function removeMentorFromObjectStorageHoldingMentors() {
		$mentor = new \Tollwerk\TwCoderdojo\Domain\Model\Person();
		$mentorsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$mentorsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($mentor));
		$this->inject($this->subject, 'mentors', $mentorsObjectStorageMock);

		$this->subject->removeMentor($mentor);

	}

	/**
	 * @test
	 */
	public function getAttendeesReturnsInitialValueForPerson() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getAttendees()
		);
	}

	/**
	 * @test
	 */
	public function setAttendeesForObjectStorageContainingPersonSetsAttendees() {
		$attendee = new \Tollwerk\TwCoderdojo\Domain\Model\Person();
		$objectStorageHoldingExactlyOneAttendees = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneAttendees->attach($attendee);
		$this->subject->setAttendees($objectStorageHoldingExactlyOneAttendees);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneAttendees,
			'attendees',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addAttendeeToObjectStorageHoldingAttendees() {
		$attendee = new \Tollwerk\TwCoderdojo\Domain\Model\Person();
		$attendeesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$attendeesObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($attendee));
		$this->inject($this->subject, 'attendees', $attendeesObjectStorageMock);

		$this->subject->addAttendee($attendee);
	}

	/**
	 * @test
	 */
	public function removeAttendeeFromObjectStorageHoldingAttendees() {
		$attendee = new \Tollwerk\TwCoderdojo\Domain\Model\Person();
		$attendeesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$attendeesObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($attendee));
		$this->inject($this->subject, 'attendees', $attendeesObjectStorageMock);

		$this->subject->removeAttendee($attendee);

	}
}
