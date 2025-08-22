<x-layout>
    <h1>Feed</h1>
    @auth()
        <form method="post" action="{{ route('posts.create') }}">
            @csrf
            <label for="post">New post</label>
            <textarea name="post" id="post"></textarea>
            <button type="submit">Create</button>
        </form>
    @endauth
    {!! $posts !!}
</x-layout>
