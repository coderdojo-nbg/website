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

use Tollwerk\TwCoderdojo\Domain\Repository\DateRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * CoderDojo-Mentor
 */
class Person extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * Typ
     *
     * @var int
     * @validate NotEmpty
     */
    protected $type = 0;

    /**
     * Geschlecht
     *
     * @var int
     * @validate NotEmpty
     */
    protected $gender = 0;

    /**
     * Vorname
     *
     * @var string
     * @validate NotEmpty
     */
    protected $firstName = '';

    /**
     * Nachname
     *
     * @var string
     * @validate NotEmpty
     */
    protected $lastName = '';

    /**
     * Geburtstag
     *
     * @var \DateTime
     * @validate NotEmpty
     */
    protected $birthday = null;

    /**
     * Portrait
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $portrait = null;

    /**
     * Biography
     *
     * @var string
     * @validate NotEmpty
     */
    protected $biography = '';

    /**
     * Mission Statement
     *
     * @var string
     */
    protected $statement = '';

    /**
     * Anonym
     *
     * @var bool
     */
    protected $anonymous = false;

    /**
     * Retired
     *
     * @var bool
     */
    protected $retired = false;

    /**
     * Kontaktmöglichkeit
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Contact>
     * @cascade remove
     * @lazy
     */
    protected $contacts = null;

    /**
     * Disziplinen
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Skill>
     * @lazy
     */
    protected $skills = null;

    /**
     * Portrait
     *
     * @var \Tollwerk\TwCoderdojo\Domain\Model\Person
     */
    protected $guardian = null;

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
        $this->contacts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->skills   = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the type
     *
     * @return int $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the type
     *
     * @param int $type
     *
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Returns the gender
     *
     * @return int $gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Sets the gender
     *
     * @param int $gender
     *
     * @return void
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * Returns the firstName
     *
     * @return string $firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Sets the firstName
     *
     * @param string $firstName
     *
     * @return void
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Returns the lastName
     *
     * @return string $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Sets the lastName
     *
     * @param string $lastName
     *
     * @return void
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Returns the birthday
     *
     * @return \DateTime $birthday
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Sets the birthday
     *
     * @param \DateTime $birthday
     *
     * @return void
     */
    public function setBirthday(\DateTime $birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * Returns the portrait
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $portrait
     */
    public function getPortrait()
    {
        return $this->portrait;
    }

    /**
     * Sets the portrait
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $portrait
     *
     * @return void
     */
    public function setPortrait(\TYPO3\CMS\Extbase\Domain\Model\FileReference $portrait)
    {
        $this->portrait = $portrait;
    }

    /**
     * Returns the biography
     *
     * @return string $biography
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * Sets the biography
     *
     * @param string $biography
     *
     * @return void
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;
    }

    /**
     * Returns the statement
     *
     * @return string $statement
     */
    public function getStatement()
    {
        return $this->statement;
    }

    /**
     * Sets the statement
     *
     * @param string $statement
     *
     * @return void
     */
    public function setStatement($statement)
    {
        $this->statement = $statement;
    }

    /**
     * Returns the anonymous
     *
     * @return bool $anonymous
     */
    public function getAnonymous()
    {
        return $this->anonymous;
    }

    /**
     * Sets the anonymous
     *
     * @param bool $anonymous
     *
     * @return void
     */
    public function setAnonymous($anonymous)
    {
        $this->anonymous = $anonymous;
    }

    /**
     * Returns the boolean state of anonymous
     *
     * @return bool
     */
    public function isAnonymous()
    {
        return $this->anonymous;
    }

    /**
     * Returns the retired
     *
     * @return bool $retired
     */
    public function getRetired()
    {
        return $this->retired;
    }

    /**
     * Sets the retired
     *
     * @param bool $retired
     *
     * @return void
     */
    public function setRetired($retired)
    {
        $this->retired = $retired;
    }

    /**
     * Returns the boolean state of retired
     *
     * @return bool
     */
    public function isRetired()
    {
        return $this->retired;
    }

    /**
     * Adds a Contact
     *
     * @param \Tollwerk\TwCoderdojo\Domain\Model\Contact $contact
     *
     * @return void
     */
    public function addContact(\Tollwerk\TwCoderdojo\Domain\Model\Contact $contact)
    {
        $this->contacts->attach($contact);
    }

    /**
     * Removes a Contact
     *
     * @param \Tollwerk\TwCoderdojo\Domain\Model\Contact $contactToRemove The Contact to be removed
     *
     * @return void
     */
    public function removeContact(\Tollwerk\TwCoderdojo\Domain\Model\Contact $contactToRemove)
    {
        $this->contacts->detach($contactToRemove);
    }

    /**
     * Returns the contacts
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Contact> $contacts
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Sets the contacts
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Contact> $contacts
     *
     * @return void
     */
    public function setContacts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $contacts)
    {
        $this->contacts = $contacts;
    }

    /**
     * Adds a Skill
     *
     * @param \Tollwerk\TwCoderdojo\Domain\Model\Skill $skill
     *
     * @return void
     */
    public function addSkill(\Tollwerk\TwCoderdojo\Domain\Model\Skill $skill)
    {
        $this->skills->attach($skill);
    }

    /**
     * Removes a Skill
     *
     * @param \Tollwerk\TwCoderdojo\Domain\Model\Skill $skillToRemove The Skill to be removed
     *
     * @return void
     */
    public function removeSkill(\Tollwerk\TwCoderdojo\Domain\Model\Skill $skillToRemove)
    {
        $this->skills->detach($skillToRemove);
    }

    /**
     * Returns the skills
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Skill> $skills
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Sets the skills
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwCoderdojo\Domain\Model\Skill> $skills
     *
     * @return void
     */
    public function setSkills(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $skills)
    {
        $this->skills = $skills;
    }

    /**
     * Returns the legal guardian
     *
     * @return \Tollwerk\TwCoderdojo\Domain\Model\Person
     */
    public function getGuardian()
    {
        return $this->guardian;
    }

    /**
     * Sets the legal guardian
     *
     * @param \Tollwerk\TwCoderdojo\Domain\Model\Person $guardian
     */
    public function setGuardian($guardian)
    {
        $this->guardian = $guardian;
    }

    /**
     * Return the age of this person
     *
     * @return int
     */
    public function getAge()
    {
        $birthday = $this->getBirthday();
        if ($birthday instanceof \DateTime) {
            $birthday          = $birthday->format('U');
            $dayOfTheYear      = date('z');
            $birthdayOfTheYear = date('z', $birthday);

            return date('Y') - date('Y', $birthday) - (($dayOfTheYear >= $birthdayOfTheYear) ? 0 : 1);
        } else {
            return 0;
        }
    }

    /**
     * Return all dates this mentor attended
     *
     * @return QueryResultInterface
     */
    public function getDates()
    {
        $objectManager  = GeneralUtility::makeInstance(ObjectManager::class);
        $dateRepository = $objectManager->get(DateRepository::class);

        return $dateRepository->findByMentor($this);
    }

    /**
     * Find an email contact of this person
     *
     * @return null|string Email address
     */
    public function getEmail()
    {
        /** @var Contact $contact */
        foreach ($this->getContacts() as $contact) {
            if ($contact->getType() == 1) {
                return $contact->getValue();
            }
        }

        return null;
    }
}
