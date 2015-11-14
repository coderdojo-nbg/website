<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

/*
 * CoderDojo date plugin
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Tollwerk.' . $_EXTKEY,
	'Date',
	array(
		'Date' => 'list,show',
	),
	// non-cacheable actions
	array(
		'Date' => '',
	)
);

/*
 * CoderDojo mentor plugin
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Tollwerk.' . $_EXTKEY,
	'Mentor',
	array(
		'Mentor' => 'list,show',
	),
	// non-cacheable actions
	array(
		'Mentor' => '',
	)
);