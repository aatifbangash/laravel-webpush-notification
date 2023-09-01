<x-layouts.base>
    <x-slot:title>
        Home page
    </x-slot>

        <x-header/>
    {{ $slot }}

    @if(!empty($showFooter))
        @include('footer')
    @endif
</x-layouts.base>
