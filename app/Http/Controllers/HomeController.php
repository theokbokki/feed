<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', [
            'groups' => Post::orderBy('created_at', 'ASC')
                ->get()
                ->groupBy(function ($post) {
                    return $post->created_at->format('Y-m-d');
                }),
        ]);
    }
}
