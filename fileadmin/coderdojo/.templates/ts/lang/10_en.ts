# ENGLISH (DEFAULT)
config {
	htmlTag_langKey							= de
	sys_language_uid						= 0
	language										= de
	locale_all									= de_DE
}
page.meta {
	description.field						= description
	description.ifEmpty					= Club für Kinder und Jugendliche von 5-17 Jahren, die begleitet von erfahrenen Mentoren Programmieren lernen &amp; Spaß haben wollen ☯ Teilnahme kostenlos, Hilfe willkommen!
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
	<meta property="og:description" name="twitter:description" content="Club für Kinder und Jugendliche von 5-17 Jahren, die begleitet von erfahrenen Mentoren Programmieren lernen &amp; Spaß haben wollen ☯ Teilnahme kostenlos, Hilfe willkommen!">
	<meta property="og:image" content="https://coderdojo-nbg.org/fileadmin/coderdojo/img/coderdojo-nbg-facebook.jpg">
	<meta name="twitter:image" content="https://coderdojo-nbg.org/fileadmin/coderdojo/img/coderdojo-nbg-twitter.png">
)

# Unset some meta tags for mentor single view
[globalVar = TSFE:id = 7][globalVar = TSFE:id = 8]
	page.headerData.503 >
[global]

# Different data for Take A Seat
[PIDinRootline = 21]
page.headerData.500.value (
	<meta property="og:site_name" content="CoderDojo Nürnberg">
	<meta property="og:type" content="website">
	<meta property="og:locale" content="de_DE">
	<meta property="fb:app_id" content="1648537765413795">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@CoderDojoNBG">
	<meta name="twitter:creator" content="@CoderDojoNBG">
	<meta property="og:url" content="
)
page.headerData.503.value (
	<meta property="og:title" name="twitter:title" content="Take A Seat — Stühle für unsere Ninjas!">
	<meta property="og:description" name="twitter:description" content="Crowdfunding- &amp; Sponsoring-Kampagne des CoderDojo Nürnberg vom 1. bis 30. November 2016 zur Anschaffung von 50 Stühlen ☯ Unterstütze unsere Nachwuchsförderung und werde Stuhlpate!">
	<meta property="og:image" content="https://coderdojo-nbg.org/fileadmin/user_upload/take-a-seat/take-a-seat-facebook.png">
	<meta name="twitter:image" content="https://coderdojo-nbg.org/fileadmin/user_upload/take-a-seat/take-a-seat-twitter.png">
)
[global]
