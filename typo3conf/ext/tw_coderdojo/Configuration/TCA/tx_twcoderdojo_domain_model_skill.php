<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_skill',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'name,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('tw_coderdojo') . 'Resources/Public/Icons/tx_twcoderdojo_domain_model_skill.png'
	),
	'interface' => array(
		'showRecordFieldList' => 'hidden, name',
	),
	'types' => array(
		'1' => array('showitem' => 'hidden;;1, name, '),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(

		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),

		'name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_skill.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		
	),
);