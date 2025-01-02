<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role_id !== 1) {
                Auth::logout();
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized access'
                ], 403);
            }

            $request->session()->regenerate();
            return response()->json([
                'status' => 'success',
                'redirect' => '/dashboard'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'The provided credentials do not match our records.'
        ], 401);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1, // User role
        ]);

        Auth::login($user);

        return response()->json([
            'status' => 'success',
            'redirect' => '/dashboard'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }


    /**
     * Display a listing of all users.
     */
    public function index()
{
    $users = User::where('deleted', false)
                 ->with('role')
                 ->orderBy('created_at', 'desc')
                 ->get();
    
    return view('users', compact('users'));
}


    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = Role::all(); // Fetch roles from the database
        return view('add.add_user', compact('roles')); // Pass roles to the view
    }
    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:roles,id',
            'phone' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB
        ]);

        // Handle user image upload if provided
        $imageName = null;
        if ($request->hasFile('user_image')) {
            $imageName = Str::random(10) . '.' . $request->file('user_image')->extension();

            $imagePath = public_path('assets/img/profile_images/');

            // Ensure the directory exists
            if (!is_dir($imagePath)) {
                mkdir($imagePath, 0777, true);
            }

            $request->file('user_image')->move($imagePath, $imageName);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'city' => $request->city,
            'role_id' => $request->role_id,
            'user_image' => $imageName, // Save the image name
        ]);

        return redirect()->route('users')->with('success', 'User added successfully.');
    }



    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('edit.edit_user', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'role_id' => 'required|exists:roles,id',
            'phone' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB
        ]);

        $user = User::findOrFail($id);

        // Update basic fields
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->city = $request->city;
        $user->role_id = $request->role_id;

        // Handle user image upload if provided
        if ($request->hasFile('user_image')) {
            $imageName = Str::random(10) . '.' . $request->file('user_image')->extension();

            $imagePath = public_path('assets/img/profile_images/');

            // Ensure the directory exists
            if (!is_dir($imagePath)) {
                mkdir($imagePath, 0777, true);
            }

            // Delete the old image if it exists
            if ($user->user_image && file_exists($imagePath . $user->user_image)) {
                unlink($imagePath . $user->user_image);
            }

            // Save the new image
            $request->file('user_image')->move($imagePath, $imageName);
            $user->user_image = $imageName;
        }

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users')->with('success', 'User updated successfully.');
    }



    public function delete(User $user)
    {
        // Soft delete: update the 'deleted' column to true
        $user->update(['deleted' => true]);

        // Redirect back to users list with success message
        return redirect()->route('users')->with('success', 'User has been soft-deleted.');
    }
}