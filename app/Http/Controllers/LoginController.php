<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Usuario;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function checkLogin(LoginRequest $request)
    {

        $get_usuario = Usuario::where('login', $request->login)->first();
        if (!empty($get_usuario)) {
            if (Hash::check($request->senha, $get_usuario->senha)) {
                Auth::loginUsingId($get_usuario->id);
                return redirect()->route('menu');
            }
            return redirect()->back()->withInput()->withErrors(['Os dados informados não conferem!']);
        }
        return redirect()->back()->withInput()->withErrors(['Usuário não encontrado!']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
