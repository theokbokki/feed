<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class CreatePostController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'content' => ['required', 'string'],
            'attachments.*' => ['image', 'max:5120'],
        ]);

        $post = Post::create([
            'content' => $validated['content'],
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $image) {
                $path = $image->store('img', 'public');

                $post->attachments()->create([
                    'src' => $path,
                ]);
            }
        }

        return back();
    }
}
