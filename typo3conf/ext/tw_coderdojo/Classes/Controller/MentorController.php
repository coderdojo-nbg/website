<?php

namespace Tollwerk\TwCoderdojo\Controller;


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
 * MentorController
 */
class MentorController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * Person repository
     *
     * @var \Tollwerk\TwCoderdojo\Domain\Repository\PersonRepository
     * @inject
     */
    protected $personRepository;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $this->view->assign('mentors', $this->personRepository->findMentors((boolean)$this->settings['retired']));
    }

    /**
     * action show
     *
     * @param \Tollwerk\TwCoderdojo\Domain\Model\Person $mentor
     * @param int $back Back PID
     * @return void
     */
    public function showAction(\Tollwerk\TwCoderdojo\Domain\Model\Person $mentor, $back = null)
    {
        $this->view->assign('mentor', $mentor);
        $this->view->assign('back', $back ?: $this->settings['pages']['mentorListPid']);
    }
}
