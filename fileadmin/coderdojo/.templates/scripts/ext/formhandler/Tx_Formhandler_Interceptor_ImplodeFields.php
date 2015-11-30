<?php
/*                                                                        *
 * This script is part of the TYPO3 project - inspiring people to share!  *
 *                                                                        *
 * TYPO3 is free software; you can redistribute it and/or modify it under *
 * the terms of the GNU General Public License version 2 as published by  *
 * the Free Software Foundation.                                          *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *
 * $Id: Tx_Formhandler_Interceptor_Default.php 27708 2009-12-15 09:22:07Z reinhardfuehricht $
 *                                                                        */

/**
 * Combines array values entered in form fields and stores it in a new entry in $this->gp.
 *
 * @author	Reinhard Führicht <rf@typoheads.at>
 * @package	Tx_Formhandler
 * @subpackage	Interceptor
 */
class Tx_Formhandler_Interceptor_ImplodeFields extends Tx_Formhandler_AbstractInterceptor {

	/**
	 * The main method called by the controller
	 *
	 * @return array The probably modified GET/POST parameters
	 */
	public function process() {
		if (is_array($this->settings['implodeFields.'])) {
			foreach ($this->settings['implodeFields.'] as $newField => $options) {
				$newField = str_replace('.', '', $newField);
				if (is_array($options) && isset($options['field']) && isset($options['separator'])) {
					$_GET[$newField] = $_POST[$newField] = $this->gp[$newField] = $this->implodeField($options);
					$this->utilityFuncs->debugMessage('imploded', array($newField, $this->gp[$newField]));
				}
			}
		}
		return $this->gp;
	}

	/**
	 * Implodes an array field
	 *
	 * @param array $options TS settings how to perform the combination
	 * @return string The combined value
	 */
	protected function implodeField($options) {
		$separator = ',';
		if (isset($options['separator'])) {
			$separator = $this->utilityFuncs->getSingle($options, 'separator');
		}
		$value = (array)$this->utilityFuncs->getGlobal($options['field'], $this->gp);
		return implode($separator, $value);
	}
}
