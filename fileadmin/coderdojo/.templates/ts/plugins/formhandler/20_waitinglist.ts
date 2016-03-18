plugin.Tx_Formhandler.settings.predef.waitinglist {
    name							= Wartelistenformular
    formID							= formhandler-waitinglist
    templateFile 					= FLUIDTEMPLATE
    templateFile{
        file						= fileadmin/coderdojo/.templates/html/ext/formhandler/waitinglist.html
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
                    type.errorCheck.1			= required
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
                    to_name							= CoderDojo Nürnberg
                    to_email						= ping@coderdojo-nbg.org
                    subject							= RECORDS
                    subject {
                        source.data					= GP:formhandler|dojo
                        tables						= tx_twcoderdojo_domain_model_date
                        conf.tx_twcoderdojo_domain_model_date = TEXT
                        conf.tx_twcoderdojo_domain_model_date {
                            dataWrap				= Anmeldung zum CoderDojo {field:dojo_number} (am {field:start})
                        }
                    }
                    sender_email					= email
                    sender_name						= fullname
                    replyto_email					= email
                    replyto_name					= fullname
                    templateFile					= FLUIDTEMPLATE
                    templateFile{
                        file						= fileadmin/coderdojo/.templates/html/ext/formhandler/mail/waitinglist_email.html
                        variables{
                            dojo					= RECORDS
                            dojo {
                                source.data			= GP:formhandler|dojo
                                tables				= tx_twcoderdojo_domain_model_date
                                conf.tx_twcoderdojo_domain_model_date = TEXT
                                conf.tx_twcoderdojo_domain_model_date {
                                    dataWrap		= {field:dojo_number} am {field:start}
                                }
                            }
                        }
                    }
                }
                user {
                    to_name							= fullname
                    to_email						= email
                    subject							= RECORDS
                    subject {
                        source.data					= GP:formhandler|dojo
                        tables						= tx_twcoderdojo_domain_model_date
                        conf.tx_twcoderdojo_domain_model_date = TEXT
                        conf.tx_twcoderdojo_domain_model_date {
                            dataWrap				= Anmeldung zum CoderDojo {field:dojo_number} (am {field:start})
                        }
                    }
                    sender_email					= ping@coderdojo-nbg.org
                    sender_name						= CoderDojo Nürnberg
                    replyto_email					= ping@coderdojo-nbg.org
                    replyto_name					= CoderDojo Nürnberg
                    templateFile					= FLUIDTEMPLATE
                    templateFile{
                        file						= fileadmin/coderdojo/.templates/html/ext/formhandler/mail/waitinglist_email.html
                        variables{
                            dojo					= RECORDS
                            dojo {
                                source.data = GP:formhandler|dojo
                                tables = tx_twcoderdojo_domain_model_date
                                conf.tx_twcoderdojo_domain_model_date = TEXT
                                conf.tx_twcoderdojo_domain_model_date {
                                    dataWrap = {field:dojo_number} am {field:start}
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
