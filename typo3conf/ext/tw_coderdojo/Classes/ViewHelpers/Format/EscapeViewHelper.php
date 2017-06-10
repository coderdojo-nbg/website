<?php

namespace Tollwerk\TwCoderdojo\ViewHelpers\Format;

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Fluid\ViewHelpers\Format\AbstractEncodingViewHelper;

class EscapeViewHelper extends AbstractEncodingViewHelper implements SingletonInterface
{
    /**
     * Escapes special texts for JavaScript strings
     *
     * @param string $value string to format
     * @return string the altered string
     * @api
     */
    public function render($value = null)
    {
        if ($value === null) {
            $value = $this->renderChildren();
        }
        return addcslashes($value, "'");
    }
}
