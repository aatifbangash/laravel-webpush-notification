<div>
    <h1>Counter</h1>
    <h1>{{ $count }}</h1>

    <button wire:click="increment">+</button>

    <button wire:click="decrement">-</button>
    {{ $token }}

    <livewire:test />
    <button wire:click="@dispatch('test-event')">==</button>
</div>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('post-created', (d) => {
            console.log(d)
            alert('created' + d);
        });
    });
        // window.livewire.on('test-event', data => {
        //     alert( 'hostelsHomepageSpotlightOpened::' )
        //     console.log('facility_opened data::')
        //     console.log(data)
        // });

</script>
