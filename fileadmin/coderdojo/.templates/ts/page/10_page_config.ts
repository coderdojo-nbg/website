# XHTML 5
config.xhtml_cleaning = all
config.doctype = html5

# CHARSET
config.metaCharset = utf-8
config.renderCharset = utf-8

# URLS
config.absRefPrefix = /
config.simulateStaticDocuments = 0
config.tx_realurl_enable = 0
config.tx_cooluri_enable = 1
config.redirectOldLinksToNew = 0
config.jumpurl_enable = 0

# LINK VARIABLES & LOCALIZATION
config.linkVars = L
config.uniqueLinkVars = 1
config.sys_language_mode = strict
config.sys_language_overlay = hideNonTranslated

# SEARCH
config.index_enable = 1
config.index_externals = 1

# EMAIL SPAM PROTECTION
config.spamProtectEmailAddresses = 1
config.spamProtectEmailAddresses_atSubst = (at)

# COMMON PAGE CONFIGURATION
page.config.admPanel = 0
config {
    intTarget = _self
    removeDefaultJS = external
    removeDefaultCss = 1
    removePageCss = 1
    compressJs = {$compressJs}
    compressCss = {$compressCss}
    concatenateCss = {$concatenateCss}
    concatenateJs = {$concatenateJs}
    concatenateJsAndCss = {$concatenateJsAndCss}
}

config.contentObjectExceptionHandler = 0