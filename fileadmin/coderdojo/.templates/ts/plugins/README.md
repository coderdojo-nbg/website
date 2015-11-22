Plugins
=======

Formhandler
-----------
Die folgenden beiden Anpassungen waren notwendig, um Formhandler unter TYPO3 7.6 LTS gangbar zu machen

### `Classes/Utils/Tx_Formhandler_UtilityFuncs.php` Zeile 1088

```php
	public function mergeConfiguration($settings, $newSettings) {
		return \TYPO3\CMS\Extbase\Utility\ArrayUtility::arrayMergeRecursiveOverrule($settings, $newSettings);
//		return \TYPO3\CMS\Core\Utility\GeneralUtility::array_merge_recursive_overrule($settings, $newSettings);
	}
```

### `Resources/PHP/class.tx_dynaflex.php' Zeile 80

```php
		$pid = $config['flexParentDatabaseRow']['pid'];
//		$pid = $config['row']['pid'];
```