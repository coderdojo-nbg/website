plugin.Tx_Formhandler.settings.predef.registration {
	name							= Anmeldeformular
	formID							= formhandler-registration
	templateFile 					= FLUIDTEMPLATE
	templateFile{
		file						= fileadmin/coderdojo/.templates/html/ext/formhandler/registration.html
		partialRootPath				= fileadmin/coderdojo/.templates/html/ext/formhandler/Partials
		partialRootPaths {
			10						= fileadmin/coderdojo/.templates/html/ext/formhandler/Partials
			20						= EXT:tw_coderdojo/Resources/Private/Partials
		}
	}

	initInterceptors.1 {
		class						= Tollwerk\TwAntibot\Formhandler\Interceptor
		config {
			templateFile			< plugin.Tx_Formhandler.settings.predef.contact.templateFile
		}
	}

	validators{
		10{
			class					= Tx_Formhandler_Validator_Default
			config {
				fieldConf {
					firstname.errorCheck.1		= required
					lastname.errorCheck.1		= required
					email.errorCheck {
						1						= required
						2 						= email
						3 						= emailExists
					}
					type.errorCheck.1			= required
				}
			}
		}
	}

	markers {
		antibotArmor				= USER_INT
		antibotArmor.userFunc		= Tollwerk\TwAntibot\Interceptor\Utility->armor
		antibotArmor.antibot		< plugin.Tx_Formhandler.settings.predef.contact.initInterceptors.1.config.antibot
	}

	saveInterceptors {
		1.class		                = Interceptor_CombineFields
		1.config {
			combineFields {
				fullname {
					fields {
						1           = firstname
						2           = lastname
					}
				}
			}
		}
	}

	finishers {
		1 {
			class									= Tx_Formhandler_Finisher_Mail
			config{
				admin {
					to_email						= ping@coderdojo-nbg.org
					subject							= Anmeldeformular CoderDojo Nürnberg
					type							= CASE
					type {
						key.data					= GP:formhandler|type
						ninja						= TEXT
						ninja.data					= LLL:fileadmin/facsimile/.templates/lang/formhandler.xml:registration.type.ninja
						mentor						= TEXT
						mentor.data					= LLL:fileadmin/facsimile/.templates/lang/formhandler.xml:registration.type.mentor
						helper						= TEXT
						helper.data					= LLL:fileadmin/facsimile/.templates/lang/formhandler.xml:registration.type.helper
					}
					sender_email					= email
					sender_name						= fullname
					replyto_email					= email
					replyto_name					= fullname
					templateFile					= FLUIDTEMPLATE
					templateFile{
						file						= fileadmin/coderdojo/.templates/html/ext/formhandler/mail/registration_email.html
						variables{
							firstname				= TEXT
							firstname{
								value.data			= GP:formhandler|firstname
							}
							lastname				= TEXT
							lastname{
								value.data			= GP:formhandler|lastname
							}
							email					= TEXT
							email{
								value.data			= GP:formhandler|email
							}
							project					= TEXT
							project{
								value.data			= GP:formhandler|project
							}
						}
					}
				}
			}
		}
		2{
			class 									= Tx_Formhandler_Finisher_Redirect
			config.redirectPage						= 15
		}
	}
}