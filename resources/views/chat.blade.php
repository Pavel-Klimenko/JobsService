<!--<!doctype html>-->
<!--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">-->
<!--<head>-->
<!--    <meta charset="utf-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--    <meta name="csrf-token" content="{{ csrf_token() }}">-->
<!--    <title>Chatbox</title>-->
<!---->
<!--    <script src="{{ @vite('resources/js/app.js') }}" defer></script>-->
<!---->
<!---->
<!--</head>-->
<!--<body>-->
<!--<div id="app">-->
<!--    <chat-component></chat-component>-->
<!--</div>-->
<!--</body>-->
<!--</html>-->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>How To Install Vue 3 in Laravel 9 with Vite</title>

    @vite('resources/css/app.css')
</head>
<body>
<div id="app"></div>

@vite('resources/js/app.js')
</body>
</html>
