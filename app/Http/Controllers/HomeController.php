<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function __invoke()
    {
        if (! Storage::disk('public')->exists('posts.md')) {
            Storage::disk('public')->put('posts.md', '');
        }

        $content = Storage::disk('public')->get('posts.md');
        $converter = new GithubFlavoredMarkdownConverter();
        $posts = $converter->convert($content);

        return view('home', [
            'posts' => $posts,
        ]);
    }
}
