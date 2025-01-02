<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show Login Form
    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    // Handle Login Request
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role_id == 1) {
                return redirect()->route('user.dashboard');
            }
            Auth::logout();
            return redirect()->route('user.login')->with('error', 'Unauthorized access.');
        }

        return redirect()->route('user.login')->with('error', 'Invalid email or password.');
    }

    // User Dashboard
    public function dashboard()
    {
        return view('user.dashboard');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}