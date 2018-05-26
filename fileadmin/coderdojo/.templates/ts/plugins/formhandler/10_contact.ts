plugin.Tx_Formhandler.settings.predef.contact {
  name = Kontaktformular
  formID = formhandler-contact
  templateFile = FLUIDTEMPLATE
  templateFile {
    file = fileadmin/coderdojo/.templates/html/ext/formhandler/contact.html
    partialRootPath = fileadmin/coderdojo/.templates/html/ext/formhandler/Partials
    partialRootPaths {
      10 = fileadmin/coderdojo/.templates/html/ext/formhandler/Partials
      20 = EXT:tw_coderdojo/Resources/Private/Partials
    }
  }

  initInterceptors.1 {
    class = Tollwerk\TwAntibot\Formhandler\Interceptor
    config {
      templateFile < plugin.Tx_Formhandler.settings.predef.contact.templateFile
    }
  }

  validators {
    10 {
      class = Tx_Formhandler_Validator_Default
      config {
        fieldConf {
          firstname.errorCheck.1 = required
          lastname.errorCheck.1 = required
          email.errorCheck {
            1 = required
            2 = email
            3 = emailExists
          }
          privacy.errorCheck.1 = required
        }
      }
    }
  }

  markers {
    antibotArmor = USER_INT
    antibotArmor.userFunc = Tollwerk\TwAntibot\Formhandler\Utility->armor
    antibotArmor.antibot < plugin.Tx_Formhandler.settings.predef.contact.initInterceptors.1.config.antibot
  }

  saveInterceptors {
    1.class = Interceptor_CombineFields
    1.config {
      combineFields {
        fullname {
          fields {
            1 = firstname
            2 = lastname
          }
        }
      }
    }
  }

  finishers {
    1 {
      class = Tx_Formhandler_Finisher_Mail
      config {
        admin {
          to_name = CoderDojo Nürnberg
          to_email = ping@coderdojo-nbg.org
          subject = Kontaktformular CoderDojo Nürnberg
          sender_email = email
          sender_name = fullname
          replyto_email = email
          replyto_name = fullname
          templateFile = FLUIDTEMPLATE
          templateFile {
            file = fileadmin/coderdojo/.templates/html/ext/formhandler/mail/contact_email.html
          }
        }

        user {
          to_name = fullname
          to_email = email
          subject = Nachricht an das CoderDojo Nürnberg
          sender_email = ping@coderdojo-nbg.org
          sender_name = CoderDojo Nürnberg
          replyto_email = ping@coderdojo-nbg.org
          replyto_name = CoderDojo Nürnberg
          templateFile = FLUIDTEMPLATE
          templateFile {
            file = fileadmin/coderdojo/.templates/html/ext/formhandler/mail/contact_email.html
          }
        }
      }
    }

    2 {
      class = Tx_Formhandler_Finisher_Redirect
      config.redirectPage = 13
    }
  }
}
