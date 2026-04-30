<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:0,15',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);
        Contact::create($validated);
        return redirect()->back()->with('success', 'Your contact message has been sent successfully!');
    }
}
