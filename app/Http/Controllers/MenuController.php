<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function show()
    {
        if (Auth::check() === true) {
            return view('menu');
        }
        return redirect()->route('login');
    }
}
