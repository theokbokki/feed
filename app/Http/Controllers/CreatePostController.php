<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class CreatePostController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'post' => ['required'],
        ]);

        Post::create([
            'content' => $request->post,
        ]);

        return back();
    }
}
