<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Profile;

class GalleryController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $galleries = Gallery::where('is_active', true)->orderBy('sort_order')->get();
        $categories = $galleries->pluck('category')->unique()->filter();
        return view('frontend.gallery', compact('profile', 'galleries', 'categories'));
    }
}
