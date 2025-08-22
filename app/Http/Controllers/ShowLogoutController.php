<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ShowLogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('logout');
    }
}
