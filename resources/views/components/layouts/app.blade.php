<x-layouts.base>
    <x-slot:title>{{ $title ?? 'Heartbeat Portal' }}</x-slot>

    @if(in_array(request()->route()->getName(), ['home', 'login', 'register']))
        @include('header')
    @endif

    @if(!in_array(request()->route()->getName(), ['home', 'login', 'register']))
        @include('nav')
        @include('sidebar')
    @endif

    {{ $slot }}

    @include('toast')
    @if(in_array(request()->route()->getName(), ['home', 'login', 'register']))
        @include('footer')
    @endif

</x-layouts.base>
