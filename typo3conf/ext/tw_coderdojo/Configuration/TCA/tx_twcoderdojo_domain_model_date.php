<?php
return array(
	'ctrl' => array(
		'title' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_date',
		'label' => 'dojo_number',
		'label_alt' => 'start,location',
		'label_alt_force' => true,
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => true,

		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'start,end,location,mentors,attendees,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('tw_coderdojo') . 'Resources/Public/Icons/tx_twcoderdojo_domain_model_date.png'
	),
	'interface' => array(
		'showRecordFieldList' => 'hidden, start, end, location, mentors, attendees',
	),
	'types' => array(
		'1' => array('showitem' => '--palette--;;event, location, intro;;;richtext:rte_transform[mode=ts_links], mentors, attendees, '),
	),
	'palettes' => array(
		'event' => array('showitem' => 'dojo_number, start, end, hidden', 'canNotCollapse' => true),
	),
	'columns' => array(

		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'dojo_number' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_date.dojo_number',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'trim,int'
			),
		),
		'start' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_date.start',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime,required',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			),
		),
		'end' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_date.end',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime,required',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			),
		),
		'location' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_date.location',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_twcoderdojo_domain_model_location',
				'minitems' => 0,
				'maxitems' => 1,
				'suppress_icons' => 1,
			),
		),
		'intro' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_date.intro',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords' => 1,
						'RTEonly' => 1,
						'module' => array(
							'name' => 'wizard_rich_text_editor',
							'urlParameters' => array(
								'mode' => 'wizard',
								'act' => 'wizard_rte.php'
							)
						),
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
		),
		'mentors' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_date.mentors',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_twcoderdojo_domain_model_person',
				'foreign_table_where' => 'AND tx_twcoderdojo_domain_model_person.type = 0',
				'MM' => 'tx_twcoderdojo_date_person_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
			),
		),
		'attendees' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_date.attendees',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_twcoderdojo_domain_model_person',
				'foreign_table_where' => 'AND tx_twcoderdojo_domain_model_person.type = 1',
				'MM' => 'tx_twcoderdojo_date_attendees_person_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
			),
		),

	),
);