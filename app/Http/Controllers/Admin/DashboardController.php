<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Partner;
use App\Models\Gallery;
use App\Models\ContactMessage;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'services' => Service::count(),
            'partners' => Partner::count(),
            'galleries' => Gallery::count(),
            'messages' => ContactMessage::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
            'testimonials' => Testimonial::count(),
        ];

        $recentMessages = ContactMessage::latest()->limit(5)->get();
        $recentGalleries = Gallery::latest()->limit(6)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentGalleries'));
    }
}
