<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;

class AdminContactController extends Controller
{
    public function index(Request $request)
    {
        $messages = ContactMessage::latest()->get();
        $unreadCount = ContactMessage::where('status', 'unread')->count();

        return view('admin.contacts.index', compact('messages', 'unreadCount'));
    }

    public function markAsRead(ContactMessage $contact)
    {
        $contact->status = $contact->status === 'read' ? 'unread' : 'read';
        $contact->save();

        return back()->with('success', 'Message status updated.');
    }

    public function destroy(ContactMessage $contact)
    {
        $contact->delete();
        return back()->with('success', 'Message deleted successfully.');
    }
}
