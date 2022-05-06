<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MZT test assignment</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="min-h-[100%] bg-[#FAF6F0] bg-opacity-100">
<div id="app">
    <div class="w-full bg-[#1E3D44] p-6 text-right text-white font-bold">My wallet
        <svg class="inline-block mx-2" height="25" width="25" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             x="0px" y="0px" viewBox="0 0 44 44" style="enable-background:new 0 0 44 44;" xml:space="preserve">
            <g>
                <path style="fill:#F0C419;" d="M22,44C9.869,44,0,34.131,0,22S9.869,0,22,0s22,9.869,22,22S34.131,44,22,44z"/>
                <path style="fill:#FBD490;" d="M22.745,32h-1.491C20.009,32,19,30.991,19,29.745V13.255C19,12.009,20.009,11,21.255,11h1.491
                    C23.991,11,25,12.009,25,13.255v16.491C25,30.991,23.991,32,22.745,32z"/>
                <path style="fill:#F0C419;" d="M22,44C9.869,44,0,34.131,0,22S9.869,0,22,0s22,9.869,22,22S34.131,44,22,44z"/>
                <path style="fill:#FBD490;" d="M22.745,32h-1.491C20.009,32,19,30.991,19,29.745V13.255C19,12.009,20.009,11,21.255,11h1.491
                    C23.991,11,25,12.009,25,13.255v16.491C25,30.991,23.991,32,22.745,32z"/>
            </g>
        </svg>
        {{$coins ?? '?' }} Coins</div>
    <div class="container my-24 px-6 mx-auto">
        <candidates :candidates="{{ json_encode($candidates) }}"></candidates>
    </div>
</div>

<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
