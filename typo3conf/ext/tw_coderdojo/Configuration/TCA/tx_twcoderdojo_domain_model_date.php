<?php
return array(
	'ctrl' => array(
		'title' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_date',
		'label' => 'dojo_number',
		'label_alt' => 'start,location',
		'label_alt_force' => true,
		'tstamp' => 'tstamp',
		'type' => 'type',
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
		'0' => array('showitem' => '--palette--;;regular, --palette--;;capacity, location, intro;;;richtext:rte_transform[mode=ts_links], mentors, ninjas, helpers'),
		'1' => array('showitem' => '--palette--;;camp, --palette--;;capacity, location, intro;;;richtext:rte_transform[mode=ts_links], mentors, ninjas, helpers'),
	),
	'palettes' => array(
		'regular' => array('showitem' => 'type, dojo_number, start, end, hidden', 'canNotCollapse' => true),
		'camp' => array('showitem' => 'type, name, start, end, hidden', 'canNotCollapse' => true),
		'capacity' => array('showitem' => 'capacity, full_override, capacity_ninjas_only', 'canNotCollapse' => true),
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
				'size' => 1,
				'eval' => 'trim,int'
			),
		),
		'capacity' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_date.capacity',
			'config' => array(
				'type' => 'input',
				'size' => 1,
				'eval' => 'trim,int',
                'default' => 50,
			),
		),
        'capacity_ninjas_only' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_date.capacityNinjasOnly',
            'config' => array(
                'type' => 'check',
                'default' => 0
            ),
        ),
        'full_override' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_date.fullOverride',
            'config' => array(
                'type' => 'check',
                'default' => 0
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
				'foreign_table_where' => 'AND tx_twcoderdojo_domain_model_person.type = 0 AND tx_twcoderdojo_domain_model_person.hidden = 0 AND tx_twcoderdojo_domain_model_person.deleted = 0 ORDER BY tx_twcoderdojo_domain_model_person.last_name ASC, tx_twcoderdojo_domain_model_person.first_name ASC',
				'MM' => 'tx_twcoderdojo_date_mentor_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
			),
		),
		'ninjas' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_date.ninjas',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_twcoderdojo_domain_model_person',
				'foreign_table_where' => 'AND tx_twcoderdojo_domain_model_person.type = 1 AND tx_twcoderdojo_domain_model_person.hidden = 0 AND tx_twcoderdojo_domain_model_person.deleted = 0 ORDER BY tx_twcoderdojo_domain_model_person.last_name ASC, tx_twcoderdojo_domain_model_person.first_name ASC',
				'MM' => 'tx_twcoderdojo_date_ninja_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
			),
		),
		'helpers' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_date.helpers',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_twcoderdojo_domain_model_person',
				'foreign_table_where' => 'AND tx_twcoderdojo_domain_model_person.type = 2 AND tx_twcoderdojo_domain_model_person.hidden = 0 AND tx_twcoderdojo_domain_model_person.deleted = 0 ORDER BY tx_twcoderdojo_domain_model_person.last_name ASC, tx_twcoderdojo_domain_model_person.first_name ASC',
				'MM' => 'tx_twcoderdojo_date_helper_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
			),
		),
		'type' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_date.type',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
				'multiple' => 0,
                'items' => [
                    ['LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_date.type.regular', 0],
                    ['LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_date.type.camp', 1],
                ]
			),
		),
        'name' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_date.name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
	),
);
