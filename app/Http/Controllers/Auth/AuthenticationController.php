<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('Auth.login');
    }

    public function storeLogin(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->route('admin.campaigns.index');
        } else {
            return back()->with('error', "Email or password not correct");
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
