<x-layout>
    <h1 class="app__title">Feed</h1>
    @auth()
        <form method="post" action="{{ route('posts.create') }}" class="app__form">
            @csrf
            <label for="post" class="app__label">New post</label>
            <div id="editor"></div>
            <button type="submit" class="app__button">Create</button>
        </form>
    @endauth
    <main class="app__main">
        @foreach($posts as $post)
            {!! $post->content !!}
            @if (!$loop->last)
                <hr>
            @endif
        @endforeach
    </main>
</x-layout>
