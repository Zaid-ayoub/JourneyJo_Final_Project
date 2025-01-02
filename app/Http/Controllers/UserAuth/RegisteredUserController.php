<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use App\Models\PublicUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.user-register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'city' => ['required', 'string', 'max:255'],
        'phone' => ['required', 'string', 'max:20'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = User::create([
        'name' => $request->name,
        'city' => $request->city,
        'phone' => $request->phone,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => 1,
        'user_image' => 'default.png',
    ]);

    event(new Registered($user));

    Auth::guard('public_user')->login($user);

    return redirect()->route('public.index');
}

}