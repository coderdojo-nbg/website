<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript',
    'CoderDojo Nürnberg');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_twcoderdojo_domain_model_person',
    'EXT:tw_coderdojo/Resources/Private/Language/locallang_csh_tx_twcoderdojo_domain_model_person.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_twcoderdojo_domain_model_person');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_twcoderdojo_domain_model_contact',
    'EXT:tw_coderdojo/Resources/Private/Language/locallang_csh_tx_twcoderdojo_domain_model_contact.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_twcoderdojo_domain_model_contact');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_twcoderdojo_domain_model_skill',
    'EXT:tw_coderdojo/Resources/Private/Language/locallang_csh_tx_twcoderdojo_domain_model_skill.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_twcoderdojo_domain_model_skill');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_twcoderdojo_domain_model_date',
    'EXT:tw_coderdojo/Resources/Private/Language/locallang_csh_tx_twcoderdojo_domain_model_date.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_twcoderdojo_domain_model_date');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_twcoderdojo_domain_model_location',
    'EXT:tw_coderdojo/Resources/Private/Language/locallang_csh_tx_twcoderdojo_domain_model_location.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_twcoderdojo_domain_model_location');

\TYPO3\CMS\Backend\Sprite\SpriteManager::addSingleIcons(array(
    'mentor' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY).'Resources/Public/Icons/tx_twcoderdojo_domain_model_mentor.png',
    'ninja' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY).'Resources/Public/Icons/tx_twcoderdojo_domain_model_ninja.png',
    'helper' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY).'Resources/Public/Icons/tx_twcoderdojo_domain_model_helper.png',
), $_EXTKEY);

// Date plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Date',
    'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xml:tt_content.list_type.date'
);

// Mentor plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Mentor',
    'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xml:tt_content.list_type.mentor'
);

if (TYPO3_MODE === 'BE') {
    /**
     * Registers a Backend Module
     */
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Tollwerk.'.$_EXTKEY,
        'tools',
        'coderdojo',  // Submodule key
        '',            // Position
        array(
            'CoderDojo' => 'index,download,downloadAll',
        ),
        array(
            'access' => 'admin',
            'icon' => 'EXT:'.$_EXTKEY.'/Resources/Public/Icons/module.png',
            'labels' => 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/locallang_mod.xlf',
        )
    );
}
