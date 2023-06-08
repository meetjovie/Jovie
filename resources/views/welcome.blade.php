<!DOCTYPE html>
<!--
     ██  ██████  ██    ██ ██ ███████
     ██ ██    ██ ██    ██ ██ ██
     ██ ██    ██ ██    ██ ██ █████
██   ██ ██    ██  ██  ██  ██ ██
 █████   ██████    ████   ██ ███████


 Come hack with us at Jovie: https://jov.ie/careers/

 -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--- OpenGraph -->
        <meta property="og:image:height" content="333">
        <meta property="og:image:width" content="636">
        <meta property="og:description" content="Jovie CRM creates & enriches contacts from social media profiles. Import contacts in 1-click from anywhere on the web. Try Jovie today for free.">
        <meta property="og:title" content="Jovie Social CRM | Organize everyone you follow.">
        <meta property="og:url" content="http://jov.ie">
        <meta property="og:image" content="https://jovie-production-store.s3.amazonaws.com/og-image.jpg">
        <!-- End OpenGraph -->

        <!-- FavIcons -->
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#635bff">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<!-- End FavIcons -->
        <!--Segment-->
        <script defer>
        !function(){var analytics=window.analytics=window.analytics||[];if(!analytics.initialize)if(analytics.invoked)window.console&&console.error&&console.error("Segment snippet included twice.");else{analytics.invoked=!0;analytics.methods=["trackSubmit","trackClick","trackLink","trackForm","pageview","identify","reset","group","track","ready","alias","debug","page","once","off","on","addSourceMiddleware","addIntegrationMiddleware","setAnonymousId","addDestinationMiddleware"];analytics.factory=function(e){return function(){var t=Array.prototype.slice.call(arguments);t.unshift(e);analytics.push(t);return analytics}};for(var e=0;e<analytics.methods.length;e++){var key=analytics.methods[e];analytics[key]=analytics.factory(key)}analytics.load=function(key,e){var t=document.createElement("script");t.type="text/javascript";t.async=!0;t.src="https://cdn.segment.com/analytics.js/v1/" + key + "/analytics.min.js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(t,n);analytics._loadOptions=e};analytics._writeKey="IO2AevGCArwqlMBurYcUIIn9QpuDkOUg";;analytics.SNIPPET_VERSION="4.15.3";
        analytics.load('{{ config('app.segment_write_key') }}');
        //analytics.page();
        }}();
        </script>
        <!--End Segment-->
      <!--   Start Atlas -->
      <script defer>(()=>{"use strict";const t={appId:"rr5tc0w7w4",v:2,q:[],start:function(o){this.autorun=o||!0},identify:function(t){this.q.push(["identify",t])}};window.Atlas=t;const e=document.createElement("script");e.async=!0,e.src="https://app.getatlas.io/client-js/atlas.bundle.js";const s=document.getElementsByTagName("script")[0];s.parentNode?.insertBefore(e,s)})();</script>
  <!--       End Atlas -->
     
        <title>Jovie</title>
        @vite(['resources/js/app.js'])
    </head>
    <body class="h-screen my-auto overscroll-x-none overflow-x-hidden">
        <div id="app">
            <App></App>
        </div>
    </body>
</html>
