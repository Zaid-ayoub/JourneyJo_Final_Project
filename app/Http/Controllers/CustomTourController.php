<?php

namespace App\Http\Controllers;

use App\Models\CustomTour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomTourController extends Controller
{
    public function create()
    {
        return view('public.custom_tour');
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_input' => 'required|string',  // Validate the location input
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'number_of_people' => 'required|integer|min:1',
            'budget' => 'required|numeric|min:0',
            'special_requirements' => 'nullable|string',
            'transportation_preference' => 'required|string|in:public,private',
        ]);

        $customTour = new CustomTour();
        $customTour->user_id = Auth::guard('public_user')->id();
        $customTour->location_input = $request->location_input;  // Store the location input
        $customTour->start_date = $request->start_date;
        $customTour->end_date = $request->end_date;
        $customTour->number_of_people = $request->number_of_people;
        $customTour->budget = $request->budget;

        $customTour->transportation_preference = $request->transportation_preference;

        $customTour->special_requirements = $request->special_requirements;
        $customTour->status = 'pending';

        $customTour->save();

        return redirect()->route('public.custom_tour')->with('success', 'Your custom tour has been submitted successfully!');
    }


    public function approve($id)
    {
        $customTour = CustomTour::where('id', $id)->where('company_id', null)->firstOrFail();

        // Update company_id with the authenticated company's ID
        $customTour->company_id = auth()->id();
        $customTour->status = 'approved';
        $customTour->save();

        return redirect()->back()->with('success', 'Custom tour approved successfully!');
    }


    public function index()
    {
        $user = auth()->user(); // Get the logged-in user

        if ($user->role_id == 3) { // Super Admin: Show all custom tours with a company_id
            $pendingCustomTours = CustomTour::whereNotNull('company_id')->where('status', 'pending')->get();
            $approvedCustomTours = CustomTour::whereNotNull('company_id')->where('status', 'approved')->get();
        } elseif ($user->role_id == 2) { // Company: Show only their pending and approved custom tours
            $pendingCustomTours = CustomTour::where('status', 'pending')->get();
            $approvedCustomTours = CustomTour::where('company_id', $user->id)->where('status', 'approved')->get();
        } else { // Other roles: Restrict access or show nothing
            $pendingCustomTours = collect(); // Empty collection
            $approvedCustomTours = collect(); // Empty collection
        }

        return view('custom_tour', compact('pendingCustomTours', 'approvedCustomTours'));
    }
}