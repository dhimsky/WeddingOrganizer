<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Resource route butuh method index
    public function index()
    {
        return redirect()->route('admin.profile.edit', 1);
    }

    public function edit()
    {
        // Jika belum ada profil, buat dulu
        $profile = Profile::firstOrCreate(['id' => 1], [
            'company_name' => 'Nama Perusahaan',
            'description'  => 'Deskripsi perusahaan',
            'phone'        => '-',
            'email'        => 'email@domain.com',
            'address'      => 'Alamat',
        ]);

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'company_name'    => 'required|string|max:255',
            'tagline'         => 'nullable|string',
            'description'     => 'required|string',
            'founded_year'    => 'nullable|string',
            'phone'           => 'required|string',
            'email'           => 'required|email',
            'address'         => 'required|string',
            'instagram'       => 'nullable|string',
            'facebook'        => 'nullable|string',
            'whatsapp'        => 'nullable|string',
            'tiktok'          => 'nullable|string',
            'youtube'         => 'nullable|string',
            'events_done'     => 'nullable|integer',
            'happy_couples'   => 'nullable|integer',
            'team_members'    => 'nullable|integer',
            'years_experience'=> 'nullable|integer',
            'logo'            => 'nullable|image|max:2048',
            'hero_image'      => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('profile', 'public');
        }
        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('profile', 'public');
        }

        Profile::updateOrCreate(['id' => 1], $data);

        return redirect()->back()->with('success', 'Profil berhasil diupdate!');
    }
}