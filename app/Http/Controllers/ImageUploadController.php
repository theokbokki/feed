<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image'],
        ]);

        $path = $request->file('image')->store('posts', 'public');
        $url = Storage::url($path);

        return response()->json(['url' => $url]);
    }
}
