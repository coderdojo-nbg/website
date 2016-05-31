<?php

namespace Typoheads\Formhandler\Validator\ErrorCheck {

    /**
     * Validates that an uploaded image has minimum dimensions
     *
     * @package    Tx_Formhandler
     * @subpackage    ErrorChecks
     */
    class FileMinDimensions extends AbstractErrorCheck
    {

        public function init($gp, $settings)
        {
            parent::init($gp, $settings);
            $this->mandatoryParameters = array('minWidth', 'minHeight');
        }

        public function check()
        {
            $checkFailed = '';
            $minWidth = intval($this->utilityFuncs->getSingle($this->settings['params'], 'minWidth'));
            $minHeight = intval($this->utilityFuncs->getSingle($this->settings['params'], 'minHeight'));
            foreach ($_FILES as $sthg => &$files) {
                if (!is_array($files['name'][$this->formFieldName])) {
                    $files['name'][$this->formFieldName] = array($files['name'][$this->formFieldName]);
                }
                if (empty($files['name'][$this->formFieldName][0])) {
                    $files['name'][$this->formFieldName] = array();
                }

                if ((count($files['name'][$this->formFieldName]) > 0) && in_array(strtolower(pathinfo($files['name'][$this->formFieldName][0],
                        PATHINFO_EXTENSION)), array('png', 'jpg')) && $minWidth && $minHeight
                ) {
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
}

namespace Typoheads\Formhandler\Interceptor {

    /**
     * Combines array values entered in form fields and stores it in a new entry in $this->gp.
     *
     * @author    Reinhard Führicht <rf@typoheads.at>
     * @package    Tx_Formhandler
     * @subpackage    Interceptor
     */
    class ImplodeFields extends AbstractInterceptor
    {

        /**
         * The main method called by the controller
         *
         * @return array The probably modified GET/POST parameters
         */
        public function process()
        {
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
        protected function implodeField($options)
        {
            $separator = ',';
            if (isset($options['separator'])) {
                $separator = $this->utilityFuncs->getSingle($options, 'separator');
            }
            $value = (array)$this->utilityFuncs->getGlobal($options['field'], $this->gp);
            return implode($separator, $value);
        }
    }
}

namespace {

    /**
     * Test if the current dojo is completely booked
     *
     * @return bool
     */
    function user_isDojoFull()
    {
        $booked = false;

        if (!empty($_GET['tx_twcoderdojo_date']) && is_array($_GET['tx_twcoderdojo_date']) && !empty($_GET['tx_twcoderdojo_date']['date'])) {
            $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\Extbase\\Object\\ObjectManager');
            $dateRepository = $objectManager->get('Tollwerk\\TwCoderdojo\\Domain\\Repository\\DateRepository');
            $date = $dateRepository->findByUid($_GET['tx_twcoderdojo_date']['date']);
            var_dump($date->getFull());
        }

        return $booked;
    }
}