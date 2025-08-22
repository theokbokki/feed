<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreLogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        if (!auth()->check()) {
            return redirect('/login')->with('status', 'No user logged in.');
        }

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'Logged out!');
    }
}
