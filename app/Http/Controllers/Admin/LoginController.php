<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $userData = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($userData, $remember)) {
            return redirect()->route('admin.dashboard.index');
        }

        return redirect()->route('login')->with('error', 'Invalid Credentials');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
