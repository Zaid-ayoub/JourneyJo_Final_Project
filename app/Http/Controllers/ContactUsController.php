<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function __construct()
    {
        // Get the latest 3 messages
        $messages = ContactUs::with('user')->latest()->limit(3)->get();
        $messageCount = $messages->count();

        // Share the messages and message count globally
        view()->share('latestMessages', $messages);
        view()->share('messageCount', $messageCount);
    }

    /**
     * List all contact messages (accessible only to super_admins).
     */
    public function index()
    {
        if (auth()->user()->role_id !== 3) {
            abort(403, 'Unauthorized action.'); // Restrict access to super_admins only
        }

        // Eager load the 'user' relationship
        $messages = ContactUs::with('user')->latest()->get();

        return view('contact_us', compact('messages'));
    }

    /**
     * Show a specific contact message.
     */
    public function show($id)
    {
        if (auth()->user()->role_id !== 3) {
            abort(403, 'Unauthorized action.'); // Restrict access to super_admins only
        }

        $message = ContactUs::with('user')->findOrFail($id);

        return view('contact_us.show', compact('message'));
    }


    public function toggleTestimonial($id)
    {
        $message = ContactUs::findOrFail($id);

        // Toggle the value of add_to_testimonial
        $message->add_to_testimonial = !$message->add_to_testimonial;
        $message->save();

        return redirect()->route('contact_us')->with('success', 'Testimonial status updated.');
    }


    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'message' => 'required|string',
        ]);

        // Create a new contact message
        $contactMessage = new ContactUs([
            'user_id' => auth('public_user')->id(), // Get the logged-in user ID
            'user_email' => auth('public_user')->user()->email, // Get the logged-in user's email
            'message' => $request->message,
        ]);

        // Save the contact message
        $contactMessage->save();

        // Redirect back with a success message
        return redirect()->route('contact.index')->with('success', 'Your message has been sent!');
    }
}