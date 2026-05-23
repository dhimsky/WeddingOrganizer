<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index() { return view('admin.messages.index', ['messages' => ContactMessage::latest()->paginate(15)]); }
    public function show(ContactMessage $message) {
        $message->update(['is_read' => true]);
        return view('admin.messages.show', compact('message'));
    }
    public function destroy(ContactMessage $message) { $message->delete(); return redirect()->route('admin.messages.index')->with('success', 'Pesan dihapus!'); }
    public function markRead(ContactMessage $message) { $message->update(['is_read' => true]); return redirect()->back(); }
}
