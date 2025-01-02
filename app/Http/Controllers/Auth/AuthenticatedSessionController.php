<?php

namespace App\Http\Controllers\Auth;

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
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    // Authenticate the user
    $request->authenticate();

    // Check the authenticated user's role_id
    if (!in_array(Auth::user()->role_id, [2, 3])) {
        // Log out the user immediately
        Auth::logout();

        // Optionally, invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the login page with an error message
        return redirect()->route('user.login')->withErrors([
            'email' => 'Access denied. Only accounts with role_id 2 or 3 are allowed.',
        ]);
    }

    // Regenerate session to prevent session fixation
    $request->session()->regenerate();

    // Redirect to the intended page
    return redirect()->intended(RouteServiceProvider::HOME);
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return redirect('/');
    }
}