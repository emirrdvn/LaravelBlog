<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('back.auth.login');
    }
    public function loginpost(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login')->withErrors('Email ve şifre uyuşmamaktadır.',);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
