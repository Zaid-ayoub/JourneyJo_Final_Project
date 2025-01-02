<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserTourController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('deleted', false)->get();

        $query = Tour::with(['company', 'images', 'category'])->where('deleted', false);

        // Handle search
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('company', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        // Apply category filter
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Paginate results
        $tours = $query->orderBy('created_at', 'desc')->paginate(9);

        // Calculate duration for each tour
        $tours->getCollection()->transform(function ($tour) {
            if ($tour->start_date && $tour->end_date) {
                $tour->duration = Carbon::parse($tour->start_date)->diffInDays(Carbon::parse($tour->end_date)) + 1;
            } else {
                $tour->duration = null;
            }
            return $tour;
        });

        return view('public.tours', compact('tours', 'categories'));
    }
}