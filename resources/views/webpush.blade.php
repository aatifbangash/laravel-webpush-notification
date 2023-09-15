<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
<h3>webpush</h3>
<a href="{{route('push')}}" target="_blank" class="btn btn-outline-primary btn-block">Make a Push Notification!</a>
<script src="{{ asset('js/enable-push.js') }}" defer></script>
</body>
</html>
