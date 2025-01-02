<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicBookingController extends Controller
{
    public function showBookingForm($tour_id)
    {
        $tour = Tour::findOrFail($tour_id);

        // Check if tour is still available
        if ($tour->available_seats <= 0) {
            return redirect()->back()->with('error', 'Sorry, this tour is fully booked.');
        }

        return view('public.booking', compact('tour'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,tour_id',
            'number_of_people' => 'required|integer|min:1',
        ]);

        $tour = Tour::findOrFail($request->tour_id);

        // Check seat availability
        if ($tour->available_seats < $request->number_of_people) {
            return back()->with('error', 'Not enough seats available.');
        }

        $totalPrice = $tour->price * $request->number_of_people;

        $booking = new Booking();
        $booking->user_id = Auth::guard('public_user')->id();
        $booking->tour_id = $tour->tour_id;
        $booking->number_of_people = $request->number_of_people;
        $booking->total_price = $totalPrice;
        $booking->payment_status = 'unpaid';
        $booking->status = 'pending';


        // Save the booking
        $booking->save();


        // Update tour seats
        $tour->decrement('available_seats', $request->number_of_people);
        // Redirect with explicit booking ID
        return redirect()->route('public.booking.success', ['booking' => $booking->booking_id])
            ->with('success', 'Booking confirmed!');
    }




    public function success($booking)
    {
        $booking = Booking::findOrFail($booking);

        // Ensure booking belongs to the logged-in user
        if ($booking->user_id !== Auth::guard('public_user')->id()) {
            abort(403);
        }

        return view('public.booking_success', compact('booking'));
    }




    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::guard('public_user')->id())
            ->with(['tour'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('public.my_bookings', compact('bookings'));
    }

    public function cancel(Booking $booking)
    {
        // Ensure the booking belongs to the logged-in user
        if ($booking->user_id !== Auth::guard('public_user')->id()) {
            abort(403);
        }

        // Only allow cancellation of pending bookings
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Sorry, this booking cannot be cancelled.');
        }

        // Update booking status
        $booking->update([
            'status' => 'cancelled'
        ]);

        // Return seats to tour availability
        $booking->tour->increment('available_seats', $booking->number_of_people);

        return redirect()->route('public.my.bookings')
            ->with('success', 'Your booking has been cancelled successfully.');
    }
}