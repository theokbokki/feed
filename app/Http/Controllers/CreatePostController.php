<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CreatePostController extends Controller
{
    public function __invoke(Request $request)
    {
        $post = $request->post;
        $content = Storage::disk('public')->get('posts.md');

        $combined = $post."\n\n---\n\n".$content;

        Storage::disk('public')->put('posts.md', $combined);

        return back();
    }
}
