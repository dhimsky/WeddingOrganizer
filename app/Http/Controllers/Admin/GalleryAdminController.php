<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryAdminController extends Controller
{
    public function index() { return view('admin.gallery.index', ['galleries' => Gallery::orderBy('sort_order')->paginate(12)]); }
    public function create() { return view('admin.gallery.form', ['gallery' => new Gallery()]); }
    public function store(Request $request) {
        $data = $request->validate(['title' => 'required', 'description' => 'nullable|string', 'category' => 'nullable|string', 'file_type' => 'required|in:image,video', 'is_featured' => 'nullable|boolean', 'is_active' => 'nullable|boolean', 'sort_order' => 'integer', 'file_path' => 'required|file|max:20480']);
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        if ($request->hasFile('file_path')) $data['file_path'] = $request->file('file_path')->store('gallery', 'public');
        Gallery::create($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Media berhasil ditambahkan!');
    }
    public function edit(Gallery $gallery) { return view('admin.gallery.form', compact('gallery')); }
    public function update(Request $request, Gallery $gallery) {
        $data = $request->validate(['title' => 'required', 'description' => 'nullable|string', 'category' => 'nullable|string', 'file_type' => 'required|in:image,video', 'is_featured' => 'nullable|boolean', 'is_active' => 'nullable|boolean', 'sort_order' => 'integer', 'file_path' => 'nullable|file|max:20480']);
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        if ($request->hasFile('file_path')) $data['file_path'] = $request->file('file_path')->store('gallery', 'public');
        $gallery->update($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Media berhasil diupdate!');
    }
    public function destroy(Gallery $gallery) { $gallery->delete(); return redirect()->route('admin.gallery.index')->with('success', 'Media dihapus!'); }
    public function upload(Request $request) {
        $request->validate(['file' => 'required|file|max:20480']);
        $path = $request->file('file')->store('gallery', 'public');
        return response()->json(['path' => $path, 'url' => asset('storage/' . $path)]);
    }
}
