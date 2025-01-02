<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersAuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.user-login'); // Make sure this Blade file exists
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/index'); // Redirect after login
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput($request->only('email'));
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}