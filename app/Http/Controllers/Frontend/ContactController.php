<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Profile;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        return view('frontend.contact', compact('profile'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'event_type' => 'nullable|string|max:100',
            'event_date' => 'nullable|date',
            'budget_range' => 'nullable|string|max:100',
            'message' => 'required|string',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Pesan Anda telah terkirim! Kami akan segera menghubungi Anda.');
    }
}
