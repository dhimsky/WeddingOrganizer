<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\Setting;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index() { return view('admin.testimonials.index', ['testimonials' => Testimonial::latest()->paginate(10)]); }
    public function create() { return view('admin.testimonials.form', ['testimonial' => new Testimonial()]); }
    public function store(Request $request) {
        $data = $request->validate(['couple_name' => 'required', 'event_date' => 'required', 'event_type' => 'nullable|string', 'testimonial' => 'required', 'rating' => 'integer|min:1|max:5', 'photo' => 'nullable|image|max:2048', 'is_featured' => 'nullable|boolean', 'is_active' => 'nullable|boolean']);
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        if ($request->hasFile('photo')) $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial ditambahkan!');
    }
    public function edit(Testimonial $testimonial) { return view('admin.testimonials.form', compact('testimonial')); }
    public function update(Request $request, Testimonial $testimonial) {
        $data = $request->validate(['couple_name' => 'required', 'event_date' => 'required', 'event_type' => 'nullable|string', 'testimonial' => 'required', 'rating' => 'integer|min:1|max:5', 'photo' => 'nullable|image|max:2048', 'is_featured' => 'nullable|boolean', 'is_active' => 'nullable|boolean']);
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        if ($request->hasFile('photo')) $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial diupdate!');
    }
    public function destroy(Testimonial $testimonial) { $testimonial->delete(); return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial dihapus!'); }
}
