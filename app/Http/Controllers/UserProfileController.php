<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\CustomTour;


class UserProfileController extends Controller
{
    /**
     * Show the profile edit form for the authenticated user.
     */
    public function edit()
    {
        $user = Auth::guard('public_user')->user();
        return view('public.profile', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::guard('public_user')->id(),
            'phone' => 'nullable|string|max:15',
            'city' => 'nullable|string|max:255',
            'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get the authenticated user
        $user = Auth::guard('public_user')->user();

        // Update basic fields
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->city = $request->input('city');

        // Handle user image upload if provided
        if ($request->hasFile('user_image')) {
            // Generate a unique file name
            $imageName = Str::random(10) . '.' . $request->file('user_image')->extension();

            // Store the image in the 'profile_images' directory inside public path
            $imagePath = public_path('assets/img/profile_images/');

            // Ensure the directory exists
            if (!is_dir($imagePath)) {
                mkdir($imagePath, 0777, true);
            }

            // Store the image
            $request->file('user_image')->move($imagePath, $imageName);

            // Save the image name in the database
            $user->user_image = $imageName;
        }


        // Save the updated user profile
        $user->save();

        // Redirect to the profile page with success message
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed', // Ensure the new password is confirmed
        ]);

        // Get the authenticated user
        $user = Auth::guard('public_user')->user();

        // Check if the current password matches the stored password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);

        // Save the updated user profile
        $user->save();

        // Redirect to the profile page with success message
        return redirect()->route('user.profile')->with('success', 'Password updated successfully!');
    }

    public function showBookingHistory()
    {
        $user = Auth::guard('public_user')->user();
    
        // Fetch regular bookings
        $bookings = $user->bookings()
            ->with('tour')
            ->orderBy('created_at', 'desc')
            ->paginate(6);
    
        // Fetch custom bookings (custom tours)
        $customTours = CustomTour::where('user_id', $user->id)
            ->with('company') // Load the related company
            ->orderBy('created_at', 'desc')
            ->paginate(6);
    
        return view('public.profile', compact('user', 'bookings', 'customTours'));
    }
    


}