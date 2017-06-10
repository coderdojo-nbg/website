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
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Veranstaltungstermin
 */
class Date extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Dojo-Typ
     *
     * @var int
     */
    protected $type = 0;

    /**
     * Dojo-Nummer
     *
     * @var int
     */
    protected $dojoNumber = 0;

    /**
     * Dojo-Name
     *
     * @var string
     */
    protected $name = '';

    /**
     * Kapazität
     *
     * @var int
     * @validate NotEmpty
     */
    protected $capacity = 0;

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
     * Sortierte Ninjas
     *
     * @var array
     */
    protected $_sortedNinjas = null;

    /**
     * Sortierte Helfer
     *
     * @var array
     */
    protected $_sortedHelpers = null;

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
     * Return the capacity
     *
     * @return int
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set the capacity
     *
     * @param int $capacity capacity
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
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
            $this->_sortedMentors = $this->sortPersons($this->mentors);
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
     * Returns the ninjas sorted by name
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Person> $ninjas
     */
    public function getSortedNinjas()
    {
        if ($this->_sortedNinjas === null) {
            $this->_sortedNinjas = $this->sortPersons($this->ninjas);
        }

        return $this->_sortedNinjas;
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
     * Returns the helpers sorted by name
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Person> $helpers
     */
    public function getSortedHelpers()
    {
        if ($this->_sortedHelpers === null) {
            $this->_sortedHelpers = $this->sortPersons($this->helpers);
        }

        return $this->_sortedHelpers;
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
    public function getAttendeesCount()
    {
        return count($this->mentors) + count($this->ninjas) + count($this->helpers);
    }

    /**
     * Return if the date is fully booked
     *
     * @return bool Fully booked
     */
    public function getFull()
    {
        return $this->getAttendeesCount() >= $this->capacity;
    }

    /**
     * Sort a list of persons by first and last name
     *
     * @param ObjectStorage $persons Persons
     * @return array Sorted list of persons
     */
    protected function sortPersons(ObjectStorage $persons)
    {
        $sortedPersons = [];
        foreach ($persons as $person) {
            $sortedPersons[] = $person;
        }

        usort($sortedPersons, function ($person1, $person2) {
            /**
             * @var Person $person1
             * @var Person $person2
             */
            return strnatcasecmp($person1->getLastName().','.$person1->getFirstName(),
                $person2->getLastName().','.$person2->getFirstName());
        });

        $sortedPersonsObjStorage = new ObjectStorage();
        foreach ($sortedPersons as $sortedPerson) {
            $sortedPersonsObjStorage->attach($sortedPerson);
        }

        return $sortedPersonsObjStorage;
    }

    /**
     * Returns the dojo type
     *
     * @return int Dojo type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the dojo type
     *
     * @param int $type Dojo type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Returns the dojo name
     *
     * @return string Sets the dojo name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the dojo name
     *
     * @param string $name Dojo name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
