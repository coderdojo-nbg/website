# ENGLISH (DEFAULT)
config {
	htmlTag_langKey							= de
	sys_language_uid						= 0
	language										= de
	locale_all									= de_DE
}
page.meta {
	description.field						= description
	description.ifEmpty					= Club für Kinder und Jugendliche von 5-17 Jahren, die begleitet von erfahrenen Mentoren Programmieren lernen & Spaß haben wollen ☯ Teilnahme kostenlos, Hilfe willkommen!
}

page.headerData.500						= TEXT
page.headerData.500.value (
	<meta property="og:site_name" content="CoderDojo Nürnberg">
	<meta property="og:type" content="website">
	<meta property="og:locale" content="de_DE">
	<meta property="fb:app_id" content="1648537765413795">
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@CoderDojoNBG">
	<meta name="twitter:creator" content="@CoderDojoNBG">
	<meta property="og:url" content="
)
page.headerData.501						< lib.canonical
page.headerData.502						= TEXT
page.headerData.502.value				= ">
page.headerData.503						= TEXT
page.headerData.503.value (
	<meta property="og:title" name="twitter:title" content="CoderDojo Nürnberg">
	<meta property="og:description" name="twitter:description" content="Club für Kinder und Jugendliche von 5-17 Jahren, die begleitet von erfahrenen Mentoren Programmieren lernen & Spaß haben wollen ☯ Teilnahme kostenlos, Hilfe willkommen!">
	<meta property="og:image" content="https://coderdojo-nbg.org/fileadmin/coderdojo/img/coderdojo-nbg-facebook.jpg">
	<meta name="twitter:image" content="https://coderdojo-nbg.org/fileadmin/coderdojo/img/coderdojo-nbg-twitter.png">
)

# Unset some meta tags for mentor single view
[globalVar = TSFE:id = 7][globalVar = TSFE:id = 8]
	page.headerData.503 >
[global]
