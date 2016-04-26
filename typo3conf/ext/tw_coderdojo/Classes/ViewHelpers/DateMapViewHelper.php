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

use TYPO3\CMS\Core\Resource\Exception\ResourceDoesNotExistException;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Extbase\Domain\Model\AbstractFileFolder;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Genitive viewhelper
 *
 * @package Tollwerk\TwCoderdojo\ViewHelpers
 */
class DateMapViewHelper extends AbstractViewHelper
{
    /**
     * Disable the escaping interceptor because otherwise the child nodes would be escaped before this view helper
     * can decode the text's entities.
     *
     * @var bool
     */
    protected $escapingInterceptorEnabled = false;

    /**
     * @var array
     */
    protected $typoScriptSetup;

    /**
     * @var \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController contains a backup of the current $GLOBALS['TSFE'] if used in BE mode
     */
    protected $tsfeBackup;

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     */
    protected $configurationManager;

    /**
     * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager
     * @return void
     */
    public function injectConfigurationManager(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager)
    {
        $this->configurationManager = $configurationManager;
        $this->typoScriptSetup = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
    }

    /**
     * Renders an image including a Google Map for a date
     *
     * @param float $latitude Latitude
     * @param float $longitude Longitude
     * @param string $client Client ("facebook", "twitter")
     * @return string Image URL
     */
    public function render($latitude, $longitude, $client = 'facebook')
    {
        switch (strtolower($client)) {
            case 'facebook':
                $size = '470x492';
                break;
            case 'twitter':
                $size = '500x340';
                break;
            default:
                return '';
                break;
        }

        $data = 'typo3temp'.DIRECTORY_SEPARATOR.'coderdojo-map-'.md5($latitude.$longitude.$size).'.jpg';
        $googleMap = "https://maps.googleapis.com/maps/api/staticmap?center=$latitude,$longitude&size=$size&zoom=14&markers=color:red|$latitude,$longitude";
        if (!@file_exists(PATH_site.$data)) {
            copy($googleMap, PATH_site.$data);
        }
        $currentValue = null;
        if (is_object($data)) {
            $data = \TYPO3\CMS\Extbase\Reflection\ObjectAccess::getGettableProperties($data);
        } elseif (is_string($data) || is_numeric($data)) {
            $currentValue = (string)$data;
            $data = array($data);
        }
        /** @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $contentObject */
        $contentObject = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer::class);
        $contentObject->start($data, '');
        if ($currentValue !== null) {
            $contentObject->setCurrentVal($currentValue);
        }
        $pathSegments = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode('.', 'lib.coderdojo.'.$client);
        $lastSegment = array_pop($pathSegments);
        $setup = $this->typoScriptSetup;
        foreach ($pathSegments as $segment) {
            if (!array_key_exists(($segment . '.'), $setup)) {
                throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('TypoScript object path "' . htmlspecialchars('lib.coderdojo.'.$client) . '" does not exist', 1253191023);
            }
            $setup = $setup[$segment . '.'];
        }
        return $contentObject->cObjGetSingle($setup[$lastSegment], $setup[$lastSegment . '.']);
    }
}
