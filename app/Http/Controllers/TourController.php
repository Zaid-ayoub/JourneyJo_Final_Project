<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Location;
use App\Models\Category;
use App\Models\User;
use App\Models\TourImage;
use Illuminate\Http\Request;


class TourController extends Controller
{
    public function index()
{
    $user = auth()->user(); // Get the logged-in user

    if ($user->role_id == 3) {
        // Admin: Fetch all tours (deleted = false), ordered by newest first
        $tours = Tour::with(['company', 'category', 'images'])
            ->where('deleted', false)
            ->orderBy('created_at', 'desc') // Order by created_at in descending order
            ->get();
    } elseif ($user->role_id == 2) {
        // Company: Fetch only tours created by the logged-in company, ordered by newest first
        $tours = Tour::with(['company', 'category', 'images'])
            ->where('deleted', false)
            ->where('company_id', $user->id) // Match the logged-in user's ID
            ->orderBy('created_at', 'desc') // Order by created_at in descending order
            ->get();
    } else {
        // Other roles: Fetch no tours (or customize as needed)
        $tours = collect(); // Empty collection
    }

    return view('tour', compact('tours'));
}




public function create()
{
    $categories = Category::where('deleted', false)->get();
    $locations = Location::where('deleted', false)->get(); // Fetch locations
    $companies = User::all(); // Assuming users can act as companies
    return view('add.add_tour', compact('categories', 'companies', 'locations'));
}


public function store(Request $request)
{
    $request->validate([
        'name' => 'required|max:255',
        'price' => 'required|numeric',
        'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
        'additional_images' => 'nullable|array',
        'additional_images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
        'description' => 'required|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'available_seats' => 'required|integer|min:1',
        'category_id' => 'required|exists:categories,category_id',
        'locations' => 'nullable|array', // Validation for selected locations
        'locations.*' => 'exists:locations,location_id', // Ensure each location exists
    ]);

    // Create the tour
    $tour = new Tour();
    $tour->name = $request->name;
    $tour->price = $request->price;
    $tour->description = $request->description;
    $tour->start_date = $request->start_date;
    $tour->end_date = $request->end_date;
    $tour->available_seats = $request->available_seats;
    $tour->category_id = $request->category_id;
    $tour->company_id = auth()->id();

    // Handle cover image
    if ($request->hasFile('cover_image')) {
        $coverImage = $request->file('cover_image');
        $coverImageName = time() . '.' . $coverImage->getClientOriginalExtension();
        $coverImage->move(public_path('assets/img/tours'), $coverImageName);
        $tour->cover_image = $coverImageName;
    }

    $tour->save();

    // Handle additional images
    if ($request->hasFile('tour_images')) {
        foreach ($request->file('tour_images') as $image) {
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $uniqueFileName = $originalName . '_' . time() . '.' . $extension;

            $image->move(public_path('assets/img/tour_images'), $uniqueFileName);

            TourImage::create([
                'tour_id' => $tour->tour_id,
                'image_path' => $uniqueFileName,
            ]);
        }
    }

    // Attach locations to the tour
    if ($request->has('locations')) {
        $tour->locations()->sync($request->locations); // Sync selected locations
    }

    return redirect()->route('tour')->with('success', 'Tour created successfully!');
}


    public function show($tour_id)
    {
        $tour = Tour::findOrFail($tour_id); // Use tour_id here
        return view('tour.show', compact('tour'));
    }

    public function edit($id)
{
    // Fetch the tour along with its associated images and locations
    $tour = Tour::with(['images', 'locations'])->find($id);

    // Check if the tour is found
    if (!$tour) {
        return redirect()->route('tour.index')->with('error', 'Tour not found');
    }

    // Fetch categories and locations from the database
    $categories = Category::where('deleted', false)->get();
    $locations = Location::where('deleted', false)->get(); // Fetch locations

    // Pass the tour, categories, and locations to the view
    return view('edit.edit_tour', compact('tour', 'categories', 'locations'));
}


public function showBookings($tour_id)
{
    // Fetch the tour by ID, including related bookings and users
    $tour = Tour::with('bookings.user')->findOrFail($tour_id);

    // Get the users who have booked the tour
    $bookings = $tour->bookings;

    return view('show.show_bookings', compact('tour', 'bookings'));
}




public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,category_id',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'available_seats' => 'required|integer',
        'cover_image' => 'nullable|image|max:10240',
        'tour_images.*' => 'nullable|image|max:10240',
        'locations' => 'nullable|array', // Validation for selected locations
        'locations.*' => 'exists:locations,location_id', // Ensure each location exists
    ]);

    // Find the tour by ID
    $tour = Tour::find($id);

    if (!$tour) {
        return redirect()->route('tour')->with('error', 'Tour not found');
    }

    $tour->name = $request->name;
    $tour->price = $request->price;
    $tour->category_id = $request->category_id;
    $tour->start_date = $request->start_date;
    $tour->end_date = $request->end_date;
    $tour->available_seats = $request->available_seats;
    $tour->description = $request->description;

    if ($request->hasFile('cover_image')) {
        $coverImage = $request->file('cover_image');
        $coverImageName = time() . '_' . $coverImage->getClientOriginalName();
        $coverImage->move(public_path('assets/img/tours'), $coverImageName);

        if ($tour->cover_image) {
            unlink(public_path('assets/img/tours/' . $tour->cover_image));
        }

        $tour->cover_image = $coverImageName;
    }

    $tour->save();

    if ($request->hasFile('tour_images')) {
        foreach ($request->file('tour_images') as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/img/tour_images'), $imageName);

            TourImage::create([
                'tour_id' => $tour->tour_id,
                'image_path' => $imageName,
            ]);
        }
    }

    // Attach selected locations
    if ($request->has('locations')) {
        $tour->locations()->sync($request->locations); // Sync selected locations
    }

    return redirect()->route('tour')->with('success', 'Tour updated successfully!');
}


    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
        $tour->deleted = true; // Set deleted column to true
        $tour->save();

        return redirect()->route('tour')->with('success', 'Tour marked as deleted.');
    }



}