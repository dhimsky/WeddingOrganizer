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
            'primary_color'    => 'nullable|string|max:7',
            'maintenance_mode' => 'nullable|in:0,1',
        ]);

        // Simpan field biasa
        Setting::set('site_title',       $request->input('site_title', ''));
        Setting::set('meta_description', $request->input('meta_description', ''));
        Setting::set('hero_tagline',     $request->input('hero_tagline', ''));
        Setting::set('primary_color',    $request->input('primary_color', '#C9A96E'));

        // Checkbox — kalau tidak dicentang tidak masuk request, default '0'
        Setting::set('maintenance_mode', $request->has('maintenance_mode') ? '1' : '0');

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}
