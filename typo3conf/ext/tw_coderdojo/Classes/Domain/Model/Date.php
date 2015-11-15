<?php
namespace Tollwerk\TwCoderdojo\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Joschi Kuphal <joschi@tollwerk.de>, tollwerk GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * Veranstaltungstermin
 */
class Date extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Startzeitpunkt
	 *
	 * @var \DateTime
	 * @validate NotEmpty
	 */
	protected $start = NULL;

	/**
	 * Endzeitpunkt
	 *
	 * @var \DateTime
	 * @validate NotEmpty
	 */
	protected $end = NULL;

	/**
	 * Veranstaltungsort
	 *
	 * @var \Tollwerk\TwCoderdojo\Domain\Model\Location
	 */
	protected $location = NULL;

	/**
	 * Mentoren
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Person>
	 * @lazy
	 */
	protected $mentors = NULL;

	/**
	 * Teilnehmer
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Person>
	 * @lazy
	 */
	protected $attendees = NULL;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->mentors = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->attendees = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the start
	 *
	 * @return \DateTime $start
	 */
	public function getStart() {
		$this->start->setTimezone(new \DateTimeZone('UTC'));
		return $this->start;
	}

	/**
	 * Sets the start
	 *
	 * @param \DateTime $start
	 * @return void
	 */
	public function setStart(\DateTime $start) {
		$this->start = $start;
	}

	/**
	 * Returns the end
	 *
	 * @return \DateTime $end
	 */
	public function getEnd() {
		$this->end->setTimezone(new \DateTimeZone('UTC'));
		return $this->end;
	}

	/**
	 * Sets the end
	 *
	 * @param \DateTime $end
	 * @return void
	 */
	public function setEnd(\DateTime $end) {
		$this->end = $end;
	}

	/**
	 * Returns the location
	 *
	 * @return \Tollwerk\TwCoderdojo\Domain\Model\Location $location
	 */
	public function getLocation() {
		return $this->location;
	}

	/**
	 * Sets the location
	 *
	 * @param \Tollwerk\TwCoderdojo\Domain\Model\Location $location
	 * @return void
	 */
	public function setLocation(\Tollwerk\TwCoderdojo\Domain\Model\Location $location) {
		$this->location = $location;
	}

	/**
	 * Adds a Person
	 *
	 * @param \Tollwerk\TwCoderdojo\Domain\Model\Person $mentor
	 * @return void
	 */
	public function addMentor(\Tollwerk\TwCoderdojo\Domain\Model\Person $mentor) {
		$this->mentors->attach($mentor);
	}

	/**
	 * Removes a Person
	 *
	 * @param \Tollwerk\TwCoderdojo\Domain\Model\Person $mentorToRemove The Person to be removed
	 * @return void
	 */
	public function removeMentor(\Tollwerk\TwCoderdojo\Domain\Model\Person $mentorToRemove) {
		$this->mentors->detach($mentorToRemove);
	}

	/**
	 * Returns the mentors
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Person> $mentors
	 */
	public function getMentors() {
		return $this->mentors;
	}

	/**
	 * Sets the mentors
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Person> $mentors
	 * @return void
	 */
	public function setMentors(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $mentors) {
		$this->mentors = $mentors;
	}

	/**
	 * Adds a Person
	 *
	 * @param \Tollwerk\TwCoderdojo\Domain\Model\Person $attendee
	 * @return void
	 */
	public function addAttendee(\Tollwerk\TwCoderdojo\Domain\Model\Person $attendee) {
		$this->attendees->attach($attendee);
	}

	/**
	 * Removes a Person
	 *
	 * @param \Tollwerk\TwCoderdojo\Domain\Model\Person $attendeeToRemove The Person to be removed
	 * @return void
	 */
	public function removeAttendee(\Tollwerk\TwCoderdojo\Domain\Model\Person $attendeeToRemove) {
		$this->attendees->detach($attendeeToRemove);
	}

	/**
	 * Returns the attendees
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Person> $attendees
	 */
	public function getAttendees() {
		return $this->attendees;
	}

	/**
	 * Sets the attendees
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Person> $attendees
	 * @return void
	 */
	public function setAttendees(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $attendees) {
		$this->attendees = $attendees;
	}

}