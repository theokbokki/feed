<x-layout>
    <h1 class="sro">Feed</h1>
    <main class="app__main">
        <section class="posts">
            @foreach($groups as $date => $posts)
                <h2 class="posts__date">{{ \Carbon\Carbon::parse($date)->format('D d M') }}</h2>
                <div class="posts__group">
                    @foreach($posts as $post)
                        <x-post :$post/>
                    @endforeach
                </div>
            @endforeach
        </section>
    </main>
    @auth()
    <form id="postForm" action="{{ route('posts.create') }}" class="app__form">
        @csrf
        <label for="content">New post</label>
        <textarea name="content" id="content" class="app_textarea"></textarea>
        <input type="file"
            id="fileInput"
            accept="image/*"
            capture
            hidden>
        <button type="button" id="addImageBtn" class="app__button">Add image</button>
        <div id="preview" class="app__preview"></div>
        <button type="submit" class="app__button">Create</button>
    </form>
    @endauth
</x-layout>
