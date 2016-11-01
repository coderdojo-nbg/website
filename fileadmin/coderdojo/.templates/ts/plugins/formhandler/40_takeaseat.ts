plugin.Tx_Formhandler.settings.predef.takeaseat {
  debug = 0
  name = Stuhlpatenschaft
  formID = formhandler-tas
  templateFile = FLUIDTEMPLATE
  templateFile {
    file = fileadmin/coderdojo/.templates/html/ext/formhandler/takeaseat.html
    partialRootPath = fileadmin/coderdojo/.templates/html/ext/formhandler/Partials
    partialRootPaths {
      10 = fileadmin/coderdojo/.templates/html/ext/formhandler/Partials
      20 = EXT:tw_coderdojo/Resources/Private/Partials
    }

    variables {
      skills = CONTENT
      skills {
        select {
          pidInList = {$plugin.tx_twcoderdojo.persistence.storagePid}
          orderBy = name
        }

        table = tx_twcoderdojo_domain_model_skill
        renderObj = TEXT
        renderObj {
          value = <li class="mentor-skill"><label><input type="checkbox" class="###is_error_skills###" name="formhandler[skills][]" value="{field:uid}" ###checked_skills_{field:uid}###/><span>{field:name}</span></label></li>
          insertData = 1
        }

        stdWrap.wrap = <div class="label">###LLL:field.skills###</div><ol class="mentor-skills">|</ol>###error_skills###
      }
    }
  }

  preProcessors {
    1.class = PreProcessor\LoadDefaultValues
    1.config {
      1 {
        black.defaultValue = 0
        basaltgrey.defaultValue = 0
        signalgrey.defaultValue = 0
        white.defaultValue = 0
        greenblue.defaultValue = 0
        avionblue.defaultValue = 0
        oxidered.defaultValue = 0
        coralred.defaultValue = 0
        yellowgrey.defaultValue = 0
        ferngreen.defaultValue = 0
        pastelgreen.defaultValue = 0
        sulfuryellow.defaultValue = 0
        amount.defaultValue = 0
      }
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
          salutation.errorCheck.1 = required
          firstname.errorCheck.1 = required
          lastname.errorCheck.1 = required
          email.errorCheck {
            1 = required
            2 = email
            3 = emailExists
          }
          address.errorCheck.1 = required
          payment.errorCheck.1 = required
          confirm.errorCheck.1 = required
          amount.errorCheck.1 = minColors
        }
      }
    }
  }

  markers {
    antibotArmor = USER_INT
    antibotArmor.userFunc = Tollwerk\TwAntibot\Formhandler\Utility->armor
    antibotArmor.antibot < plugin.Tx_Formhandler.settings.predef.contact.initInterceptors.1.config.antibot
    antibotArmor >

    net = USER_INT
    net.userFunc = Tollwerk\TwCoderdojo\Utility\Marker->net
    gross = USER_INT
    gross.userFunc = Tollwerk\TwCoderdojo\Utility\Marker->gross
    vat = USER_INT
    vat.userFunc = Tollwerk\TwCoderdojo\Utility\Marker->vat
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
          subject = [TAKE A SEAT] Übernahme einer Stuhlpatenschaft im CoderDojo Nürnberg
          sender_email = email
          sender_name = fullname
          replyto_email = email
          replyto_name = fullname
          templateFile = FLUIDTEMPLATE
          templateFile {
            file = fileadmin/coderdojo/.templates/html/ext/formhandler/mail/takeaseat_email.html
          }
        }

        user {
          to_name = fullname
          to_email = email
          subject = Take A Seat: Übernahme einer Stuhlpatenschaft im CoderDojo Nürnberg
          sender_email = ping@coderdojo-nbg.org
          sender_name = CoderDojo Nürnberg
          replyto_email = ping@coderdojo-nbg.org
          replyto_name = CoderDojo Nürnberg
          templateFile = FLUIDTEMPLATE
          templateFile {
            file = fileadmin/coderdojo/.templates/html/ext/formhandler/mail/takeaseat_email.html
            variables {
              skills = CONTENT
              skills {
                select {
                  uidInList.data = GP:fullskills
                  pidInList = {$plugin.tx_twcoderdojo.persistence.storagePid}
                  orderBy = name
                }

                table = tx_twcoderdojo_domain_model_skill
                renderObj = TEXT
                renderObj {
                  noTrimWrap = |{field:name}, |
                  insertData = 1
                }
              }

              contactform = TEXT
              contactform {
                value = Kontaktformular
                typolink {
                  parameter = 11
                  forceAbsoluteUrl = 1
                  returnLast = url
                }
              }

              mentorlist = TEXT
              mentorlist {
                value = Mentorenliste
                typolink {
                  parameter = 3
                  forceAbsoluteUrl = 1
                  returnLast = url
                }
              }
            }
          }
        }
      }
    }

    2 {
      class = Tx_Formhandler_Finisher_Redirect
      config.redirectPage = 22
    }
  }
}
