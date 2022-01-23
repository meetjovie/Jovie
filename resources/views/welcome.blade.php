<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://8638-2400-adc7-91d-db00-fadd-f5c2-f5a3-2efc.ngrok.io/css/app.css" rel="stylesheet">
        <title>Laravel</title>
    </head>
    <body class="h-screen my-auto overflow-x-hidden bg-neutral-800">
        <div id="app">
            <router-view></router-view>
        </div>

        <script src="https://8638-2400-adc7-91d-db00-fadd-f5c2-f5a3-2efc.ngrok.io/js/app.js"></script>
    </body>
</html>
