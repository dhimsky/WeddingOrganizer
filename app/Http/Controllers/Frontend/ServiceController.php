<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Profile;

class ServiceController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        return view('frontend.services', compact('profile', 'services'));
    }

    public function show(string $slug)
    {
        $profile = Profile::first();
        $service = Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $related = Service::where('is_active', true)->where('id', '!=', $service->id)->limit(3)->get();
        return view('frontend.service-detail', compact('profile', 'service', 'related'));
    }
}
