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
class Date extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

	/**
	 * Dojo-Nummer
	 *
	 * @var int
	 * @validate NotEmpty
	 */
	protected $dojoNumber = 0;

	/**
	 * Startzeitpunkt
	 *
	 * @var \DateTime
	 * @validate NotEmpty
	 */
	protected $start = null;

	/**
	 * Endzeitpunkt
	 *
	 * @var \DateTime
	 * @validate NotEmpty
	 */
	protected $end = null;

	/**
	 * Veranstaltungsort
	 *
	 * @var \Tollwerk\TwCoderdojo\Domain\Model\Location
	 */
	protected $location = null;

	/**
	 * Intro description
	 *
	 * @var string
	 */
	protected $intro = '';

	/**
	 * Mentoren
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Person>
	 * @lazy
	 */
	protected $mentors = null;

	/**
	 * Ninjas
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Person>
	 * @lazy
	 */
	protected $ninjas = null;

	/**
	 * Helpers
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Person>
	 * @lazy
	 */
	protected $helpers = null;
	
	/**
	 * Sortierte Mentoren
	 *
	 * @var array
	 */
	protected $_sortedMentors = null;

	/**
	 * __construct
	 */
	public function __construct()
	{
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
	protected function initStorageObjects()
	{
		$this->mentors = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->ninjas = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->helpers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Return the dojo number
	 *
	 * @return int
	 */
	public function getDojoNumber()
	{
		return $this->dojoNumber;
	}

	/**
	 * Set the dojo number
	 *
	 * @param int $dojoNumber Dojo number
	 */
	public function setDojoNumber($dojoNumber)
	{
		$this->dojoNumber = $dojoNumber;
	}

	/**
	 * Returns the start
	 *
	 * @return \DateTime $start
	 */
	public function getStart()
	{
		$this->start->setTimezone(new \DateTimeZone('UTC'));
		return $this->start;
	}

	/**
	 * Sets the start
	 *
	 * @param \DateTime $start
	 * @return void
	 */
	public function setStart(\DateTime $start)
	{
		$this->start = $start;
	}

	/**
	 * Returns the end
	 *
	 * @return \DateTime $end
	 */
	public function getEnd()
	{
		$this->end->setTimezone(new \DateTimeZone('UTC'));
		return $this->end;
	}

	/**
	 * Sets the end
	 *
	 * @param \DateTime $end
	 * @return void
	 */
	public function setEnd(\DateTime $end)
	{
		$this->end = $end;
	}

	/**
	 * Return the intro description
	 *
	 * @return string
	 */
	public function getIntro()
	{
		return $this->intro;
	}

	/**
	 * Set the intro description
	 *
	 * @param string $intro
	 */
	public function setIntro($intro)
	{
		$this->intro = $intro;
	}

	/**
	 * Returns the location
	 *
	 * @return \Tollwerk\TwCoderdojo\Domain\Model\Location $location
	 */
	public function getLocation()
	{
		return $this->location;
	}

	/**
	 * Sets the location
	 *
	 * @param \Tollwerk\TwCoderdojo\Domain\Model\Location $location
	 * @return void
	 */
	public function setLocation(\Tollwerk\TwCoderdojo\Domain\Model\Location $location)
	{
		$this->location = $location;
	}

	/**
	 * Adds a Person
	 *
	 * @param \Tollwerk\TwCoderdojo\Domain\Model\Person $mentor
	 * @return void
	 */
	public function addMentor(\Tollwerk\TwCoderdojo\Domain\Model\Person $mentor)
	{
		$this->mentors->attach($mentor);
	}

	/**
	 * Removes a Person
	 *
	 * @param \Tollwerk\TwCoderdojo\Domain\Model\Person $mentorToRemove The Person to be removed
	 * @return void
	 */
	public function removeMentor(\Tollwerk\TwCoderdojo\Domain\Model\Person $mentorToRemove)
	{
		$this->mentors->detach($mentorToRemove);
	}

	/**
	 * Returns the mentors
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Person> $mentors
	 */
	public function getMentors()
	{
		if ($this->_sortedMentors === null) {
			$this->_sortedMentors = [];
			foreach ($this->mentors as $mentor) {
				$this->_sortedMentors[] = $mentor;
			}

			usort($this->_sortedMentors, function($mentor1, $mentor2) {
				/**
				 * @var Person $mentor1
				 * @var Person $mentor2
				 */
				return strnatcasecmp($mentor1->getLastName().','.$mentor1->getFirstName(), $mentor2->getLastName().','.$mentor2->getFirstName());
			});
		}

		return $this->_sortedMentors;
	}

	/**
	 * Sets the mentors
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Person> $mentors
	 * @return void
	 */
	public function setMentors(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $mentors)
	{
		$this->mentors = $mentors;
	}

	/**
	 * Adds a Person
	 *
	 * @param \Tollwerk\TwCoderdojo\Domain\Model\Person $attendee
	 * @return void
	 */
	public function addNinja(\Tollwerk\TwCoderdojo\Domain\Model\Person $attendee)
	{
		$this->ninjas->attach($attendee);
	}

	/**
	 * Removes a Person
	 *
	 * @param \Tollwerk\TwCoderdojo\Domain\Model\Person $attendeeToRemove The Person to be removed
	 * @return void
	 */
	public function removeNinja(\Tollwerk\TwCoderdojo\Domain\Model\Person $attendeeToRemove)
	{
		$this->ninjas->detach($attendeeToRemove);
	}

	/**
	 * Returns the ninjas
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Person> $ninjas
	 */
	public function getNinjas()
	{
		return $this->ninjas;
	}

	/**
	 * Sets the ninjas
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Person> $ninjas
	 * @return void
	 */
	public function setNinjas(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $ninjas)
	{
		$this->ninjas = $ninjas;
	}

	/**
	 * Adds a Person
	 *
	 * @param \Tollwerk\TwCoderdojo\Domain\Model\Person $attendee
	 * @return void
	 */
	public function addHelper(\Tollwerk\TwCoderdojo\Domain\Model\Person $attendee)
	{
		$this->helpers->attach($attendee);
	}

	/**
	 * Removes a Person
	 *
	 * @param \Tollwerk\TwCoderdojo\Domain\Model\Person $attendeeToRemove The Person to be removed
	 * @return void
	 */
	public function removeHelper(\Tollwerk\TwCoderdojo\Domain\Model\Person $attendeeToRemove)
	{
		$this->helpers->detach($attendeeToRemove);
	}

	/**
	 * Returns the helpers
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Person> $helpers
	 */
	public function getHelpers()
	{
		return $this->helpers;
	}

	/**
	 * Sets the helpers
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Person> $helpers
	 * @return void
	 */
	public function setHelpers(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $helpers)
	{
		$this->helpers = $helpers;
	}

	/**
	 * Return the total number of attendees (mentors + ninjas + helpers)
	 *
	 * @return int Total number of attendees
	 */
	public function getAttendeesCount() {
		return count($this->mentors) + count($this->ninjas) + count($this->helpers);
	}
}