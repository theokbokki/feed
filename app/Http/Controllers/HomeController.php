<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', [
            'posts' => Post::orderBy('created_at', 'DESC')->get(),
        ]);
    }
}
