<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tour;
use App\Models\ContactUs;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function index()
{
    // Fetch categories
    $categories = Category::where('deleted', false)->get();

    // Fetch latest 6 tours with company and images
    $latestTours = Tour::with(['company', 'images'])
        ->where('deleted', false)
        ->orderBy('created_at', 'desc')
        ->take(6)
        ->get()
        ->map(function ($tour) {
            // Calculate duration using Carbon
            $startDate = Carbon::parse($tour->start_date);
            $endDate = Carbon::parse($tour->end_date);
            $tour->duration = $startDate->diffInDays($endDate) + 1; // Include start and end days
            return $tour;
        });

    // Fetch testimonials where add_to_testimonial is 1
    $testimonials = ContactUs::where('add_to_testimonial', 1)->get();

    // Pass testimonials to the view
    return view('public.index', compact('categories', 'latestTours', 'testimonials'));
}


    public function showTourDetails($id)
{
    // Fetch the tour by its ID and eager load related data (category, company, images, and locations)
    $tour = Tour::with(['category', 'company', 'images', 'locations'])
                ->where('tour_id', $id)
                ->firstOrFail();

    // Ensure start_date and end_date are valid before calculating duration
    if (!$tour->start_date || !$tour->end_date) {
        return redirect()->route('public.index')->with('error', 'Invalid tour dates.');
    }

    // Calculate the duration based on start_date and end_date using Carbon
    $startDate = Carbon::parse($tour->start_date);
    $endDate = Carbon::parse($tour->end_date);
    $tour->duration = $startDate->diffInDays($endDate) + 1; // Include both start and end days

    // Get the latest 3 related tours from the same category, excluding the current tour
    $relatedTours = Tour::with(['images']) // eager load images to get cover image
                        ->where('category_id', $tour->category_id)
                        ->where('tour_id', '!=', $tour->tour_id) // Exclude the current tour
                        ->orderBy('created_at', 'desc') // Order by latest
                        ->take(3) // Limit to 3 related tours
                        ->get()
                        ->map(function ($relatedTour) {
                            // Calculate duration for each related tour
                            $startDate = Carbon::parse($relatedTour->start_date);
                            $endDate = Carbon::parse($relatedTour->end_date);
                            $relatedTour->duration = $startDate->diffInDays($endDate) + 1; // Include both start and end days

                            // Add cover image if available, otherwise a default image
                            $relatedTour->cover_image = $relatedTour->images->isNotEmpty() 
                                ? asset('assets/img/tour_images/' . $relatedTour->images->first()->image_path)
                                : asset('assets/img/default_image.jpg');
                            
                            return $relatedTour;
                        });

    // Pass the tour and related tours to the view
    return view('public.single_tour', compact('tour', 'relatedTours'));
}

    

}