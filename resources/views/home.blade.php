<x-layout>
    <h1 class="sro">Feed</h1>
    @auth()
        <form method="post" action="{{ route('posts.create') }}" class="app__form">
            @csrf
            <label for="post" class="app__label">New post</label>
            <textarea id="content" name="content" class="app_textarea"></textarea>
            <button type="submit" class="app__button">Create</button>
        </form>
    @endauth
    <main class="app__main">
        <section class="posts">
            @foreach($groups as $date => $posts)
                <h2 class="posts__date">{{ \Carbon\Carbon::parse($date)->format('D d M') }}</h2>
                <div class="posts__group">
                    @foreach($posts as $post)
                        <x-post :$post />
                    @endforeach
                </div>
            @endforeach
        </section>
    </main>
</x-layout>
