<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('user.auth.login'); // Create this view for user login
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('user')->attempt($credentials)) {
            $user = Auth::guard('user')->user();
            if ($user->role_id == 1) {
                return redirect()->route('user.dashboard');
            }
            Auth::guard('user')->logout();
        }
        return redirect()->route('user.login')->withErrors(['email' => 'Invalid credentials or unauthorized access']);
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('user.login');
    }
}