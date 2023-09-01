<div>
    <h1>Test component</h1>
    {{ $name }}

    <form wire:submit.prevent="add">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" wire:model="title" />

        <label for="title">Body</label>
        <input type="text" id="body" name="body" wire:model="body" />

        <button type="submit" name="submitPost">Submit</button>
    </form>

    <h3>List</h3>
    @if(!empty($posts))
        @foreach($posts as $post)
            <hr />
            <div>
                <h3>{{ $post['title'] ?? '' }}</h3>
                <p>{{ $post['body'] ?? '' }}</p>
                <a href="{{ route('single', ['id' => $post['id']]) }}">View</a> | <button wire:click="delete({{$post['id']}})">Delete</button> | <button wire:click="edit({{$post['id']}})">Edit</button>
            </div>
        @endforeach
    @endif
    {{--    {{ $data }}--}}
</div>
