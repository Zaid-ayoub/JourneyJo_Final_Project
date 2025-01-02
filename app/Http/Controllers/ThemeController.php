<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreContactRequest;
use App\Models\category;
use App\Models\Contact;

class ThemeController extends Controller
{
    public function about(){
        return view('theme.about');
    }
    public function services(){
        return view('theme.services');
    }
    public function contact(){


        $categories = Category::all();
        return view('theme.contact', compact('categories'));
        // $data = Contact::where('first_name','=','zaid')->get();
    }
    public function store(StoreContactRequest $request){
        $validatedData = $request->validated();

        
        Contact::create($validatedData);

        return back()->with('status', 'Your massage has been sent successfully!');
    }
    public function display(){
        $data = Contact::paginate(4);
        return view('theme.display-contacts', compact('data'));
    }
}