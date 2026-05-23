<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('sort_order')->paginate(12);
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.form', ['member' => new TeamMember()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'role'       => 'required|string|max:255',
            'bio'        => 'nullable|string',
            'instagram'  => 'nullable|string',
            'photo'      => 'nullable|image|max:2048',
            'is_active'  => 'nullable|boolean',
            'sort_order' => 'integer',
        ]);

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        TeamMember::create($data);
        return redirect()->route('admin.team.index')->with('success', 'Anggota tim berhasil ditambahkan!');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.form', ['member' => $team]);
    }

    public function update(Request $request, TeamMember $team)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'role'       => 'required|string|max:255',
            'bio'        => 'nullable|string',
            'instagram'  => 'nullable|string',
            'photo'      => 'nullable|image|max:2048',
            'is_active'  => 'nullable|boolean',
            'sort_order' => 'integer',
        ]);

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        $team->update($data);
        return redirect()->route('admin.team.index')->with('success', 'Anggota tim berhasil diupdate!');
    }

    public function destroy(TeamMember $team)
    {
        // Hapus foto jika ada
        if ($team->photo) {
            \Storage::disk('public')->delete($team->photo);
        }
        $team->delete();
        return redirect()->route('admin.team.index')->with('success', 'Anggota tim dihapus!');
    }
}