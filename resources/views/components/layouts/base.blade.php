<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    {{--        @livewireStyles--}}
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body>

{{ $slot }}

{{--        @livewireScripts--}}
<script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
