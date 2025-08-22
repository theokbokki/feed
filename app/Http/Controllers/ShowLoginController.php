<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ShowLoginController extends Controller
{
    public function __invoke(Request $request)
    {
        if (auth()->check()) {
            return redirect(route('home'));
        }

        return view('login');
    }
}
