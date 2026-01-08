@use(Carbon\Carbon)

<x-layout>
    <header class="header">
        <h1 class="sro">Théoo's feed</h1>
        <div class="header__media">
            <img class="header__img" src="{{ Vite::asset('resources/img/mii.webp') }}" alt="" />
            <div class="header__text">
                <p class="header__name">Théoo</p>
                <a class="header__mail" href="mailto:hello@theoo.dev">hello@theoo.dev</a>
            </div>
        </div>
    </header>
    <main class="app__main">
        <section class="posts">
            @foreach($groups as $date => $posts)
                <h2 class="posts__date">
                    {{ ($date = Carbon::parse($date))->year > 2025 ? $date->format('D d M') : 2025 }}
                </h2>
                <div class="posts__group">
                    @foreach($posts as $post)
                        <x-post :$post/>
                    @endforeach
                </div>
            @endforeach
        </section>
        @auth()
            <div id="preview" class="post__preview"></div>
            <form id="postForm" action="{{ route('posts.create') }}" class="post__form">
                @csrf
                <label for="content" class="sro">New post</label>
                <button type="button" id="addImageBtn" class="post__button post__button--img">
                    <span class="sro">Add image</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                </button>
                <textarea name="content" id="content" class="post__textarea"></textarea>
                <input type="file"
                    id="fileInput"
                    accept="image/*"
                    capture
                    hidden>
                <button type="submit" class="post__button post__button--create">
                    <span class="sro">Create</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-icon lucide-arrow-up"><path d="m5 12 7-7 7 7"/><path d="M12 19V5"/></svg>
                </button>
            </form>
        @endauth
    </main>
</x-layout>
