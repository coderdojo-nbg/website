plugin.Tx_Formhandler.settings.predef.mentor {
	debug							= 0
	name							= Registrierung als Mentor*in
	formID							= formhandler-registration
	templateFile 					= FLUIDTEMPLATE
	templateFile{
		file						= fileadmin/coderdojo/.templates/html/ext/formhandler/mentor.html
		partialRootPath				= fileadmin/coderdojo/.templates/html/ext/formhandler/Partials
		partialRootPaths {
			10						= fileadmin/coderdojo/.templates/html/ext/formhandler/Partials
			20						= EXT:tw_coderdojo/Resources/Private/Partials
		}
		variables {
			skills					= CONTENT
			skills {
				select {
					pidInList		= {$plugin.tx_twcoderdojo.persistence.storagePid}
					orderBy			= name
				}
				table				= tx_twcoderdojo_domain_model_skill
				renderObj			= TEXT
				renderObj {
					value			= <li class="mentor-skill"><label><input type="checkbox" class="###is_error_skills###" name="formhandler[skills][]" value="{field:uid}" ###checked_skills_{field:uid}###/><span>{field:name}</span></label></li>
					insertData		= 1
				}
				stdWrap.wrap		= <div class="label">###LLL:field.skills###</div><ol class="mentor-skills">|</ol>###error_skills###
			}
		}
	}

	files {

		# Path to upload the files to (must exist!)
		uploadFolder = uploads/formhandler/

		# Allows the user to remove a previously uploaded file
		enableFileRemoval = 1

		# The default value of the link to remove a file would be "X".
		customRemovalText = TEXT
		customRemovalText {
			value = /fileadmin/coderdojo/img/delete.png
			wrap = <img src="|" />
		}
	}

	initInterceptors.1 {
		class						= Tollwerk\TwAntibot\Formhandler\Interceptor
		config {
			templateFile			< plugin.Tx_Formhandler.settings.predef.contact.templateFile
		}
	}

	preProcessors {
		1.class = Tx_Formhandler_PreProcessor_LoadDefaultValues
		1.config {
			1 {
				dojo.defaultValue				= TEXT
				dojo.defaultValue.data			= GP:tx_twcoderdojo_date|date
			}
		}
	}

	validators{
		10{
			class					= Tx_Formhandler_Validator_Default
			config {
				fieldConf {
					firstname.errorCheck.1		= required
					lastname.errorCheck.1		= required
					gender.errorCheck.1			= required
					email.errorCheck {
						1						= required
						2 						= email
						3 						= emailExists
					}
					birthday.errorCheck {
						1						= required
						2						= date
						2.pattern				= Y-m-d
						3						= isOlderThan
						3						{
							dateFormat			= Y-m-d
							years				= 5
						}
					}
					portrait.errorCheck {
						1						= fileRequired
						2						= fileAllowedTypes
						2.allowedTypes			= jpg,jpeg,png
						3						= fileMaxCount
						3.maxCount				= 1
						4						= fileMaxSize
						4.maxSize				= 1048576
						5						= fileMinDimensions
						5.minWidth				= 250
						5.minHeight				= 250
					}
					biography.errorCheck.1		= required
					statement.errorCheck.1		= required
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
		2.class		                = Interceptor_ImplodeFields
		2.config {
			implodeFields {
				fullskills {
					field           = skills
					separator       = ,
				}
			}
		}
	}

	finishers {
		1 {
			class									= Tx_Formhandler_Finisher_Mail
			config{
				admin {
					to_name							= CoderDojo Nürnberg
					to_email						= ping@coderdojo-nbg.org
					subject							= Registrierung als CoderDojo-Mentor
					sender_email					= email
					sender_name						= fullname
					replyto_email					= email
					replyto_name					= fullname
					templateFile					= FLUIDTEMPLATE
					templateFile{
						file						= fileadmin/coderdojo/.templates/html/ext/formhandler/mail/mentor_email.html
						variables{
							skills					= CONTENT
							skills {
								select {
									uidInList.data	= GP:fullskills
									pidInList		= {$plugin.tx_twcoderdojo.persistence.storagePid}
									orderBy			= name
								}
								table				= tx_twcoderdojo_domain_model_skill
								renderObj			= TEXT
								renderObj {
									noTrimWrap		= |{field:name}, |
									insertData		= 1
								}
							}
						}
					}
					attachment						= portrait
				}
				user {
					to_name							= fullname
					to_email						= email
					subject							= Registrierung als CoderDojo-Mentor
					sender_email					= ping@coderdojo-nbg.org
					sender_name						= CoderDojo Nürnberg
					replyto_email					= ping@coderdojo-nbg.org
					replyto_name					= CoderDojo Nürnberg
					templateFile					= FLUIDTEMPLATE
					templateFile{
						file						= fileadmin/coderdojo/.templates/html/ext/formhandler/mail/mentor_email.html
						variables{
							skills					= CONTENT
							skills {
								select {
									uidInList.data	= GP:fullskills
									pidInList		= {$plugin.tx_twcoderdojo.persistence.storagePid}
									orderBy			= name
								}
								table				= tx_twcoderdojo_domain_model_skill
								renderObj			= TEXT
								renderObj {
									noTrimWrap		= |{field:name}, |
									insertData		= 1
								}
							}
							contactform				 = TEXT
							contactform {
								value				= Kontaktformular
								typolink {
									parameter		= 11
									forceAbsoluteUrl		= 1
									returnLast		= url
								}
							}
							mentorlist				 = TEXT
							mentorlist {
								value				= Mentorenliste
								typolink {
									parameter		= 3
									forceAbsoluteUrl		= 1
									returnLast		= url
								}
							}
						}
					}
					attachment						= portrait
				}
			}
		}
		2{
			class 									= Tx_Formhandler_Finisher_Redirect
			config.redirectPage						= 17
		}
	}
}
