<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.user-login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    // Attempt to authenticate the user
    $request->authenticate('public_user');

    // Check if the authenticated user's role_id is not 1
    if (Auth::guard('public_user')->user()->role_id !== 1) {
        // Log out the user immediately
        Auth::guard('public_user')->logout();

        // Optionally, invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect back to login with an error message
        return redirect()->route('adminlogin')->withErrors([
            'email' => 'Unauthorized access. Only user accounts with role_id 1 are allowed.',
        ]);
    }

    // Regenerate session to prevent session fixation
    $request->session()->regenerate();

    // Redirect to the intended route
    return redirect()->route('public.index');
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('public_user')->logout();

        return redirect()->route('user.login');
    }
}