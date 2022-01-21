<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://8641-2400-adc7-91d-db00-6ee9-f118-8ec4-2fc7.ngrok.io/css/app.css" rel="stylesheet">
        <title>Laravel</title>
    </head>
    <body class="antialiased">
        <div id="app">
            <router-view></router-view>
        </div>

        <script src="https://8641-2400-adc7-91d-db00-6ee9-f118-8ec4-2fc7.ngrok.io/js/app.js"></script>
    </body>
</html>
