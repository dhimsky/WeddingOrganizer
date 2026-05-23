<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\VisionMission;
use App\Models\Service;
use App\Models\Partner;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\TeamMember;

class HomeController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $galleries = Gallery::where('is_active', true)->where('is_featured', true)->orderBy('sort_order')->limit(9)->get();
        $testimonials = Testimonial::where('is_active', true)->where('is_featured', true)->get();
        $partners = Partner::where('is_active', true)->orderBy('sort_order')->get();

        return view('frontend.home', compact('profile', 'services', 'galleries', 'testimonials', 'partners'));
    }

    public function profile()
    {
        $profile = Profile::first();
        $teamMembers = TeamMember::where('is_active', true)->orderBy('sort_order')->get();
        return view('frontend.profile', compact('profile', 'teamMembers'));
    }

    public function visionMission()
    {
        $profile = Profile::first();
        $visionMission = VisionMission::first();
        return view('frontend.vision-mission', compact('profile', 'visionMission'));
    }

    public function partners()
    {
        $profile = Profile::first();
        $partners = Partner::where('is_active', true)->orderBy('sort_order')->get();
        $categories = $partners->pluck('category')->unique()->filter();
        return view('frontend.partners', compact('profile', 'partners', 'categories'));
    }
}
