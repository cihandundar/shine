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

        if (Auth::attempt($userData)) {
            return redirect()->route('admin.dashboard.index');
        }

        return redirect()->route('login.index')->with('error', 'Invalid Credentials');
    }
}
