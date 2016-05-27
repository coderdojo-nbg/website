#ICONIZR
page.headerData.100 = FILE
page.headerData.100.file = fileadmin/coderdojo/js/icons-loader.html

#TYPEKIT
page.headerData.101 = TEXT
page.headerData.101.value = <script>(function(d){var config={kitId:'psw6afs',scriptTimeout:3000,async:true},h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)})(document);</script>

# PAGE TITLE
config.noPageTitle = 1
page.headerData.102 = TEXT
page.headerData.102 {
    field = title
    noTrimWrap = |<title>| ☯ CoderDojo Nürnberg</title>|
}

[globalVar = TSFE:id = 1]
    page.headerData.102.noTrimWrap = |<title>CoderDojo Nürnberg ☯ |</title>|
[global]

#FAVICON / TOUCH ICONS
page.headerData.200 = FILE
page.headerData.200.file = fileadmin/coderdojo/favicons/favicons.html

#META
page.meta.author = CoderDojo Nürnberg | Joschi Kuphal
page.meta.robots = index,follow
page.meta.viewport = width=device-width, initial-scale=1

# CANONICAL URL
lib.canonical = TEXT
lib.canonical.typolink {
    parameter.data = TSFE : id
    addQueryString = 1
    addQueryString {
        method = GET,POST
        exclude = cHash
    }

    returnLast = url
    useCacheHash = 0
    forceAbsoluteUrl = 1
    forceAbsoluteUrl.scheme = https
}

page.headerData.201 = COA_INT
page.headerData.201 {
    10 = TEXT
    10.value = <link rel="canonical" href="
    30 < lib.canonical
    40 = TEXT
    40.value = "/>
}

#CSS
page.includeCSS {
    above = fileadmin/coderdojo/css/coderdojo-above.css
    below = fileadmin/coderdojo/css/coderdojo-below.css
}

page.CSS_inlineStyle >
config.inlineStyle2TempFile = 1

#JAVASCRIPT
page.includeJS {
    html5 = //html5shiv.googlecode.com/svn/trunk/html5.js
    html5.external = 1
    html5.allWrap = <!--[if lt IE 9]>|<![endif]-->
    html5 {
        disableCompression = 1
        forceOnTop = 1
        excludeFromConcatenation = 1
    }
}

page.includeJSFooter {
    jquery = //ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js
    jquery {
        external = 1
        forceOnTop = 1
        disableCompression = 1
        excludeFromConcatenation = 1
    }

    jquery >
}

config.removeDefaultJS = external

[globalVar = TSFE:id = 1]
    page.bodyTag = <body class="home">
[global]

[PIDinRootline = 6]
    page.bodyTag = <body class="green">
[global]

[PIDinRootline = 4]
    page.bodyTag = <body class="blue">
[global]

[PIDinRootline = 3]
    page.bodyTag = <body class="yellow">
[global]

[PIDinRootline = 5]
    page.bodyTag = <body class="red">
[global]

[globalVar = TSFE:id = 8]
    page.bodyTag >
    page.bodyTagCObject = FILE
    page.bodyTagCObject.file = fileadmin/coderdojo/img/star.svg
    page.bodyTagCObject.wrap = <body class="blue">|
[global]

[globalVar = TSFE:id = 8] [globalVar = TSFE:id = 16]
    page.includeJSFooter {
        datepicker = fileadmin/coderdojo/js/datepicker.min.js
        datepicker {
            external = 1
            forceOnTop = 1
            disableCompression = 1
            excludeFromConcatenation = 1
        }
    }
[global]