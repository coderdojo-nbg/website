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
 * Test case for class \Tollwerk\TwCoderdojo\Domain\Model\Mentor.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Joschi Kuphal <joschi@tollwerk.de>
 */
class MentorTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Tollwerk\TwCoderdojo\Domain\Model\Mentor
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \Tollwerk\TwCoderdojo\Domain\Model\Mentor();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getFirstNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFirstName()
		);
	}

	/**
	 * @test
	 */
	public function setFirstNameForStringSetsFirstName() {
		$this->subject->setFirstName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'firstName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLastNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLastName()
		);
	}

	/**
	 * @test
	 */
	public function setLastNameForStringSetsLastName() {
		$this->subject->setLastName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'lastName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPortraitReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getPortrait()
		);
	}

	/**
	 * @test
	 */
	public function setPortraitForFileReferenceSetsPortrait() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setPortrait($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'portrait',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getBiographyReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getBiography()
		);
	}

	/**
	 * @test
	 */
	public function setBiographyForStringSetsBiography() {
		$this->subject->setBiography('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'biography',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getStatementReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getStatement()
		);
	}

	/**
	 * @test
	 */
	public function setStatementForStringSetsStatement() {
		$this->subject->setStatement('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'statement',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getContactsReturnsInitialValueForContact() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getContacts()
		);
	}

	/**
	 * @test
	 */
	public function setContactsForObjectStorageContainingContactSetsContacts() {
		$contact = new \Tollwerk\TwCoderdojo\Domain\Model\Contact();
		$objectStorageHoldingExactlyOneContacts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneContacts->attach($contact);
		$this->subject->setContacts($objectStorageHoldingExactlyOneContacts);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneContacts,
			'contacts',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addContactToObjectStorageHoldingContacts() {
		$contact = new \Tollwerk\TwCoderdojo\Domain\Model\Contact();
		$contactsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$contactsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($contact));
		$this->inject($this->subject, 'contacts', $contactsObjectStorageMock);

		$this->subject->addContact($contact);
	}

	/**
	 * @test
	 */
	public function removeContactFromObjectStorageHoldingContacts() {
		$contact = new \Tollwerk\TwCoderdojo\Domain\Model\Contact();
		$contactsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$contactsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($contact));
		$this->inject($this->subject, 'contacts', $contactsObjectStorageMock);

		$this->subject->removeContact($contact);

	}

	/**
	 * @test
	 */
	public function getSkillsReturnsInitialValueForSkill() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getSkills()
		);
	}

	/**
	 * @test
	 */
	public function setSkillsForObjectStorageContainingSkillSetsSkills() {
		$skill = new \Tollwerk\TwCoderdojo\Domain\Model\Skill();
		$objectStorageHoldingExactlyOneSkills = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneSkills->attach($skill);
		$this->subject->setSkills($objectStorageHoldingExactlyOneSkills);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneSkills,
			'skills',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addSkillToObjectStorageHoldingSkills() {
		$skill = new \Tollwerk\TwCoderdojo\Domain\Model\Skill();
		$skillsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$skillsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($skill));
		$this->inject($this->subject, 'skills', $skillsObjectStorageMock);

		$this->subject->addSkill($skill);
	}

	/**
	 * @test
	 */
	public function removeSkillFromObjectStorageHoldingSkills() {
		$skill = new \Tollwerk\TwCoderdojo\Domain\Model\Skill();
		$skillsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$skillsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($skill));
		$this->inject($this->subject, 'skills', $skillsObjectStorageMock);

		$this->subject->removeSkill($skill);

	}
}
