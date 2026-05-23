<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\VisionMission;
use Illuminate\Http\Request;

class VisionMissionController extends Controller
{
    public function edit() {
        $vm = VisionMission::firstOrNew([]);
        return view('admin.vision-mission.edit', compact('vm'));
    }
    public function update(Request $request) {
        $data = $request->validate(['vision' => 'required|string', 'mission' => 'required|array', 'values' => 'nullable|array']);
        VisionMission::updateOrCreate(['id' => 1], $data);
        return redirect()->back()->with('success', 'Visi & Misi berhasil diupdate!');
    }
}
