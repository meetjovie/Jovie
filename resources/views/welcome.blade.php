<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://1be2-2400-adc7-91d-db00-e569-2ade-d414-d13d.ngrok.io/css/app.css" rel="stylesheet">
        <title>Laravel</title>
    </head>
    <body class="h-screen my-auto overflow-x-hidden bg-neutral-800">
        <div id="app">
            <router-view></router-view>
        </div>

        <script src="https://1be2-2400-adc7-91d-db00-e569-2ade-d414-d13d.ngrok.io/js/app.js"></script>
    </body>
</html>
