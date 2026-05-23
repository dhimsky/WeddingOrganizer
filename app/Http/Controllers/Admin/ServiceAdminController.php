<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceAdminController extends Controller
{
    public function index() {
        $services = Service::orderBy('sort_order')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create() {
        return view('admin.services.form', ['service' => new Service()]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'price_start' => 'nullable|numeric',
            'price_end' => 'nullable|numeric',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'features' => 'nullable|array',
        ]);
        $data['slug'] = Str::slug($request->name);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }
        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Service berhasil ditambahkan!');
    }

    public function edit(Service $service) {
        return view('admin.services.form', compact('service'));
    }

    public function update(Request $request, Service $service) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'price_start' => 'nullable|numeric',
            'price_end' => 'nullable|numeric',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'integer',
            'features' => 'nullable|array',
        ]);
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }
        $service->update($data);
        return redirect()->route('admin.services.index')->with('success', 'Service berhasil diupdate!');
    }

    public function destroy(Service $service) {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service berhasil dihapus!');
    }
}
