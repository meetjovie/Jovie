<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--- OpenGraph -->
        <meta property="og:image:height" content="333">
        <meta property="og:image:width" content="636">
        <meta property="og:description" content="Easily build, manage, &amp; grow creator communities.">
        <meta property="og:title" content="Jovie | Scale your creator partnerships">
        <meta property="og:url" content="http://jov.ie">
        <meta property="og:image" content="https://jovie-production-store.s3.amazonaws.com/og-image.jpg">
        <!-- End OpenGraph -->
        <!--Segment-->
        <script>
        !function(){var analytics=window.analytics=window.analytics||[];if(!analytics.initialize)if(analytics.invoked)window.console&&console.error&&console.error("Segment snippet included twice.");else{analytics.invoked=!0;analytics.methods=["trackSubmit","trackClick","trackLink","trackForm","pageview","identify","reset","group","track","ready","alias","debug","page","once","off","on","addSourceMiddleware","addIntegrationMiddleware","setAnonymousId","addDestinationMiddleware"];analytics.factory=function(e){return function(){var t=Array.prototype.slice.call(arguments);t.unshift(e);analytics.push(t);return analytics}};for(var e=0;e<analytics.methods.length;e++){var key=analytics.methods[e];analytics[key]=analytics.factory(key)}analytics.load=function(key,e){var t=document.createElement("script");t.type="text/javascript";t.async=!0;t.src="https://cdn.segment.com/analytics.js/v1/" + key + "/analytics.min.js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(t,n);analytics._loadOptions=e};analytics._writeKey="IO2AevGCArwqlMBurYcUIIn9QpuDkOUg";;analytics.SNIPPET_VERSION="4.15.3";
        analytics.load("IO2AevGCArwqlMBurYcUIIn9QpuDkOUg");
        //analytics.page();
        }}();
        </script>
        <!--End Segment-->

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- {{--        <link href="/css/app.css" rel="stylesheet">--}} -->
        <title>Jovie</title>
       

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-M87NWNB');</script>
        <!-- End Google Tag Manager -->
    </head>
    <body class="h-screen my-auto overflow-x-hidden">
        <div id="app">
            <App></App>
        </div>
        <script src="{{ asset('/js/app.js') }}"></script>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M87NWNB" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <!-- {{--        <script src="/js/app.js"></script>--}} -->
        <!--  Freshchat start -->
       
       <!-- Freshchat end -->
    </body>
</html>
