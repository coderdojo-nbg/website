<?php

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
 * Validates that an uploaded image has minimum dimensions
 *
 * @package	Tx_Formhandler
 * @subpackage	ErrorChecks
 */
class Tx_Formhandler_ErrorCheck_FileMinDimensions extends \Tx_Formhandler_AbstractErrorCheck {

	public function init($gp, $settings) {
		parent::init($gp, $settings);
		$this->mandatoryParameters = array('minWidth', 'minHeight');
	}

	public function check() {
		$checkFailed = '';
		$minWidth = intval($this->utilityFuncs->getSingle($this->settings['params'], 'minWidth'));
		$minHeight = intval($this->utilityFuncs->getSingle($this->settings['params'], 'minHeight'));
		foreach ($_FILES as $sthg => &$files) {
			if(!is_array($files['name'][$this->formFieldName])) {
				$files['name'][$this->formFieldName] = array($files['name'][$this->formFieldName]);
			}
			if(empty($files['name'][$this->formFieldName][0])) {
				$files['name'][$this->formFieldName] = array();
			}

			if ((count($files['name'][$this->formFieldName]) > 0) && in_array(strtolower(pathinfo($files['name'][$this->formFieldName][0], PATHINFO_EXTENSION)), array('png', 'jpg')) && $minWidth && $minHeight) {
				$imageSize = getimagesize($files['tmp_name'][$this->formFieldName]);
				if (!$imageSize || ($imageSize[0] < $minWidth) || ($imageSize[1] < $minHeight)) {
					unset($files);
					$checkFailed = $this->getCheckFailed();
				}
			}
		}
		return $checkFailed;
	}

}