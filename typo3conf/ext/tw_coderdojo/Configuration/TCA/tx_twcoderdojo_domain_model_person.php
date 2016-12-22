<?php
return array(
  'ctrl' => array(
    'title' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_person',
    'label' => 'last_name',
    'label_alt' => 'first_name, birthday, guardian',
    'label_alt_force' => true,
    'type' => 'type',
    'tstamp' => 'tstamp',
    'crdate' => 'crdate',
    'cruser_id' => 'cruser_id',
    'dividers2tabs' => true,
    'default_sortby' => 'ORDER BY last_name, first_name',

    'delete' => 'deleted',
    'enablecolumns' => array(
      'disabled' => 'hidden',

    ),
    'searchFields' => 'type,gender,first_name,last_name,birthday,portrait,biography,statement,anonymous,contacts,skills,',
    'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('tw_coderdojo').'Resources/Public/Icons/tx_twcoderdojo_domain_model_mentor.png',
    'typeicon_column' => 'type',
    'typeicon_classes' => array(
      '0' => 'extensions-tw_coderdojo-mentor',
      '1' => 'extensions-tw_coderdojo-ninja',
      '2' => 'extensions-tw_coderdojo-helper',
    ),
  ),
  'interface' => array(
    'showRecordFieldList' => 'hidden, type, gender, first_name, last_name, birthday, portrait, biography, statement, anonymous, contacts, skills',
  ),
  'types' => array(
    '0' => array('showitem' => '--palette--;;type,--pallette--;;name, portrait, biography;;;richtext:rte_transform[mode=ts_links], statement, contacts, skills, '),
    '1' => array('showitem' => '--palette--;;type,--pallette--;;name, guardian, contacts, skills, '),
    '2' => array('showitem' => '--palette--;;type,--pallette--;;name, contacts, skills, '),
  ),
  'palettes' => array(
    'type' => array('showitem' => 'type, anonymous, hidden', 'canNotCollapse' => true),
    'name' => array('showitem' => 'gender, first_name, last_name, birthday', 'canNotCollapse' => true),
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
      'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_person.type',
      'config' => array(
        'type' => 'select',
        'renderType' => 'selectSingle',
        'items' => array(
          array(
            'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_person.type.mentor',
            0
          ),
          array(
            'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_person.type.ninja',
            1
          ),
          array(
            'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_person.type.helper',
            2
          ),
        ),
        'size' => 1,
        'maxitems' => 1,
        'eval' => 'required',
        'default' => 1,
      ),
    ),
    'gender' => array(
      'exclude' => 0,
      'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_person.gender',
      'config' => array(
        'type' => 'select',
        'renderType' => 'selectSingle',
        'items' => array(
          array(
            'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_person.gender.unspecified',
            0
          ),
          array(
            'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_person.gender.male',
            1
          ),
          array(
            'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_person.gender.female',
            2
          ),
        ),
        'size' => 1,
        'maxitems' => 1,
        'eval' => 'required'
      ),
    ),
    'first_name' => array(
      'exclude' => 0,
      'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_person.first_name',
      'config' => array(
        'type' => 'input',
        'size' => 30,
        'eval' => 'trim,required'
      ),
    ),
    'last_name' => array(
      'exclude' => 0,
      'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_person.last_name',
      'config' => array(
        'type' => 'input',
        'size' => 30,
        'eval' => 'trim,required'
      ),
    ),
    'birthday' => array(
      'exclude' => 0,
      'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_person.birthday',
      'config' => array(
        'dbType' => 'date',
        'type' => 'input',
        'size' => 7,
        'eval' => 'date,required',
        'checkbox' => 0,
        'default' => '0000-00-00'
      ),
    ),
    'portrait' => array(
      'exclude' => 0,
      'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_person.portrait',
      'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
        'portrait',
        array(
          'maxitems' => 1,
          'appearance' => array(
            'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
          ),
          'foreign_types' => array(
            '0' => array(
              'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
            ),
            \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
              'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
            ),
            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
              'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
            ),
            \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
              'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
            ),
            \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
              'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
            ),
            \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
              'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
            )
          )
        ),
        $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
      ),
    ),
    'biography' => array(
      'exclude' => 0,
      'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_person.biography',
      'config' => array(
        'type' => 'text',
        'cols' => 40,
        'rows' => 15,
        'eval' => 'trim,required',
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
    'statement' => array(
      'exclude' => 0,
      'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_person.statement',
      'config' => array(
        'type' => 'text',
        'cols' => 40,
        'rows' => 15,
        'eval' => 'trim'
      )
    ),
    'anonymous' => array(
      'exclude' => 0,
      'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_person.anonymous',
      'config' => array(
        'type' => 'check',
        'default' => 0
      )
    ),
    'contacts' => array(
      'exclude' => 0,
      'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_person.contacts',
      'config' => array(
        'type' => 'inline',
        'foreign_table' => 'tx_twcoderdojo_domain_model_contact',
        'foreign_field' => 'person',
        'maxitems' => 9999,
        'appearance' => array(
          'collapseAll' => 0,
          'levelLinksPosition' => 'top',
          'showSynchronizationLink' => 1,
          'showPossibleLocalizationRecords' => 1,
          'showAllLocalizationLink' => 1
        ),
      ),

    ),
    'skills' => array(
      'exclude' => 0,
      'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_person.skills',
      'config' => array(
        'type' => 'select',
        'renderType' => 'selectMultipleSideBySide',
        'foreign_table' => 'tx_twcoderdojo_domain_model_skill',
        'foreign_table_where' => 'ORDER BY tx_twcoderdojo_domain_model_skill.name ASC',
        'MM' => 'tx_twcoderdojo_person_skill_mm',
        'size' => 10,
        'autoSizeMax' => 30,
        'maxitems' => 9999,
        'multiple' => 0,
        'wizards' => array(
          '_PADDING' => 1,
          '_VERTICAL' => 1,
          'edit' => array(
            'module' => array(
              'name' => 'wizard_edit',
            ),
            'type' => 'popup',
            'title' => 'Edit',
            'icon' => 'edit2.gif',
            'popup_onlyOpenIfSelected' => 1,
            'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
          ),
          'add' => Array(
            'module' => array(
              'name' => 'wizard_add',
            ),
            'type' => 'script',
            'title' => 'Create new',
            'icon' => 'add.gif',
            'params' => array(
              'table' => 'tx_twcoderdojo_domain_model_skill',
              'pid' => '###CURRENT_PID###',
              'setValue' => 'prepend'
            ),
          ),
        ),
      ),
    ),
    'guardian' => array(
      'exclude' => 0,
      'label' => 'LLL:EXT:tw_coderdojo/Resources/Private/Language/locallang_db.xlf:tx_twcoderdojo_domain_model_person.guardian',
      'config' => array(
        'type' => 'select',
        'renderType' => 'selectSingle',
        'foreign_table' => 'tx_twcoderdojo_domain_model_person',
        'foreign_table_where' => 'AND tx_twcoderdojo_domain_model_person.birthday < "'.date('Y-m-d',
            mktime(0, 0, 0, date('n'), date('j'),
              date('Y') - 13)).'" ORDER BY tx_twcoderdojo_domain_model_person.last_name ASC',
        'items' => array(
          array('---', 0),
        ),
        'size' => 1,
        'minitems' => 0,
        'maxitems' => 1,
      ),
    ),
  ),
);
