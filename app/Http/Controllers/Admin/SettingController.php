<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit() {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.edit', compact('settings'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'site_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:160',
            'hero_tagline'     => 'nullable|string|max:255',
        ]);

        // Simpan field biasa
        Setting::set('site_title',       $request->input('site_title', ''));
        Setting::set('meta_description', $request->input('meta_description', ''));
        Setting::set('hero_tagline',     $request->input('hero_tagline', ''));

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}
