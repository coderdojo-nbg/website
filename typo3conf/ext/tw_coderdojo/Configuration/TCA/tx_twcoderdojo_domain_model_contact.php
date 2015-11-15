<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_contact',
		'label' => 'type',
		'label_alt' => 'value',
		'label_alt_force' => true,
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'type,value,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('tw_coderdojo') . 'Resources/Public/Icons/tx_twcoderdojo_domain_model_contact.png'
	),
	'interface' => array(
		'showRecordFieldList' => 'hidden, type, value',
	),
	'types' => array(
		'1' => array('showitem' => 'hidden;;1, --palette--;;contact, '),
	),
	'palettes' => array(
		'contact' => array('showitem' => 'type, value'),
	),
	'columns' => array(

		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),

		'type' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_contact.type',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_contact.type.website', 0),
					array('LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_contact.type.email', 1),
					array('LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_contact.type.twitter', 2),
					array('LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_contact.type.facebook', 3),
					array('LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_contact.type.googleplus', 4),
					array('LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_contact.type.github', 5),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => 'required'
			),
		),
		'value' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_contact.value',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		
		'person' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);