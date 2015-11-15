<?php

/**
 * coderdojo
 *
 * @category    Jkphl
 * @package     Jkphl_coderdojo
 * @author      Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @copyright   Copyright © 2015 Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @license     http://opensource.org/licenses/MIT	The MIT License (MIT)
 */

/***********************************************************************************
 *  The MIT License (MIT)
 *
 *  Copyright © 2015 Joschi Kuphal <joschi@kuphal.net> / @jkphl
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy of
 *  this software and associated documentation files (the "Software"), to deal in
 *  the Software without restriction, including without limitation the rights to
 *  use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 *  the Software, and to permit persons to whom the Software is furnished to do so,
 *  subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 *  FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 *  COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 *  IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 *  CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 ***********************************************************************************/

namespace Tollwerk\TwCoderdojoFt3\Controller;


use TYPO3\CMS\Core\Utility\GeneralUtility;

class PageController extends \FluidTYPO3\Fluidpages\Controller\PageController
{
	/**
	 * CoderDojo date repository
	 *
	 * @var \Tollwerk\TwCoderdojo\Domain\Repository\DateRepository
	 * @inject
	 */
	protected $dateRepository;

	/**
	 * Home action
	 */
	public function homeAction()
	{

		// Extract the current date from the request parameters if available
		$coderDojoDate = GeneralUtility::_GP('tx_twcoderdojo_date');
		if (is_array($coderDojoDate) && array_key_exists('date', $coderDojoDate) && intval($coderDojoDate['date'])) {
			$coderDojoDate = $this->dateRepository->findByIdentifier($coderDojoDate['date']);

			// Else: Get the next available date
		} else {
			$coderDojoDate = $this->dateRepository->findNext()->getFirst();
			$this->view->assign('nextLabel', true);
		}

		$this->view->assign('nextDate', $coderDojoDate);
	}
}