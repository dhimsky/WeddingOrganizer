<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index() { return view('admin.partners.index', ['partners' => Partner::orderBy('sort_order')->paginate(12)]); }
    public function create() { return view('admin.partners.form', ['partner' => new Partner()]); }
    public function store(Request $request) {
        $data = $request->validate(['name' => 'required', 'category' => 'nullable|string', 'website' => 'nullable|url', 'description' => 'nullable|string', 'is_active' => 'nullable|boolean', 'sort_order' => 'integer', 'logo' => 'required|image|max:2048']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        if ($request->hasFile('logo')) $data['logo'] = $request->file('logo')->store('partners', 'public');
        Partner::create($data);
        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil ditambahkan!');
    }
    public function edit(Partner $partner) { return view('admin.partners.form', compact('partner')); }
    public function update(Request $request, Partner $partner) {
        $data = $request->validate(['name' => 'required', 'category' => 'nullable|string', 'website' => 'nullable|url', 'description' => 'nullable|string', 'is_active' => 'nullable|boolean', 'sort_order' => 'integer', 'logo' => 'nullable|image|max:2048']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        if ($request->hasFile('logo')) $data['logo'] = $request->file('logo')->store('partners', 'public');
        $partner->update($data);
        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil diupdate!');
    }
    public function destroy(Partner $partner) { $partner->delete(); return redirect()->route('admin.partners.index')->with('success', 'Partner dihapus!'); }
}
