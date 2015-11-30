<?php

namespace Tollwerk\TwCoderdojo\ViewHelpers;

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

use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

/**
 * Genitive viewhelper
 * 
 * @package Tollwerk\TwCoderdojo\ViewHelpers
 */
class GenitiveViewHelper extends AbstractViewHelper implements CompilableInterface {

	/**
	 * Returns the genitive form of a word
	 *
	 * @param string $value string to add genitive
	 * @return string
	 */
	public function render($value = null)
	{
		return static::renderStatic(
				array(
						'value' => $value
				),
				$this->buildRenderChildrenClosure(),
				$this->renderingContext
		);
	}

	/**
	 * Returns the genitive form of a word
	 *
	 * @param array $arguments
	 * @param \Closure $renderChildrenClosure
	 * @param \TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface $renderingContext
	 * @return string
	 */
	public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
	{
		$value = $arguments['value'];
		if ($value === null) {
			$value = $renderChildrenClosure();
		}
		if (!is_string($value)) {
			return $value;
		}
		return $value.((strtolower(substr($value, -1)) == 's') ? "'" : 's');
	}
}
