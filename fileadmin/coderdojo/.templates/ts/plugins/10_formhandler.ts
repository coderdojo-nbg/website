plugin.Tx_Formhandler.settings {

	# GENERAL CONFIGURATION
	addErrorAnchors				= 0
	formValuesPrefix			= formhandler
	disableConfigValidation		= 1
	langFile					= fileadmin/coderdojo/.templates/lang/formhandler.xml
	masterTemplateFile			= fileadmin/coderdojo/.templates/html/ext/formhandler/mastertemplate.html

	# ERRORS LAYOUT
	singleErrorTemplate {
		totalWrap 				= <div class="error">|</div>
		singleWrap 				= <div class="single-error">|</div>
	}
	errorListTemplate {
		totalWrap 				= <ul>|</ul>
		singleWrap 				= <li class="error">|</li>
	}

	isErrorMarker {
		default 				= error
	}
}