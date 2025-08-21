<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Feed</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="">
        <form method="post" action="{{ route('posts.create') }}">
            @csrf
            <label for="post">New post</label>
            <textarea name="post" id="post"></textarea>
            <button type="submit">Create</button>
        </form>
        {!! $posts !!}
    </body>
</html>
