<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        if ($request->filled('status')) {
            if ($request->status === 'archived') {
                $query->where('status', 'archived');
            } elseif ($request->status === 'new') {
                $query->where('status', 'new')->orWhere('is_read', false);
            } elseif ($request->status === 'read') {
                $query->where('status', 'read')->where('is_read', true);
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $messages = $query->latest()->paginate(20);

        $stats = [
            'total' => ContactMessage::count(),
            'new' => ContactMessage::where(function($q) {
                $q->where('status', 'new')->orWhere('is_read', false);
            })->count(),
            'read' => ContactMessage::where('status', 'read')->where('is_read', true)->count(),
            'archived' => ContactMessage::where('status', 'archived')->count(),
        ];

        return view('admin.contact-messages.index', compact('messages', 'stats'));
    }

    public function show(ContactMessage $contactMessage)
    {
        $contactMessage->markAsRead();
        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    public function updateNotes(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'admin_notes' => ['nullable', 'string'],
        ]);

        $contactMessage->update($validated);
        return back()->with('success', 'Notities opgeslagen!');
    }

    public function markAsRead(ContactMessage $contactMessage)
    {
        $contactMessage->markAsRead();
        return back()->with('success', 'Gemarkeerd als gelezen');
    }

    public function markAsUnread(ContactMessage $contactMessage)
    {
        $contactMessage->markAsUnread();
        return back()->with('success', 'Gemarkeerd als ongelezen');
    }

    public function archive(ContactMessage $contactMessage)
    {
        $contactMessage->archive();
        return back()->with('success', 'Bericht gearchiveerd');
    }

    public function markAsReplied(ContactMessage $contactMessage)
    {
        $contactMessage->update([
            'replied_by' => Auth::id(),
            'replied_at' => now(),
            'status' => 'read',
            'is_read' => true,
        ]);

        return back()->with('success', 'Gemarkeerd als beantwoord');
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('admin.contact-messages.index')
                        ->with('success', 'Bericht verwijderd');
    }

    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'message_ids' => ['required', 'array'],
            'message_ids.*' => ['exists:contact_messages,id'],
            'action' => ['required', 'in:delete,archive,mark_read,mark_unread'],
        ]);

        $messages = ContactMessage::whereIn('id', $validated['message_ids']);

        switch ($validated['action']) {
            case 'delete':
                $messages->delete();
                $message = count($validated['message_ids']) . ' berichten verwijderd';
                break;

            case 'archive':
                $messages->update(['status' => 'archived']);
                $message = count($validated['message_ids']) . ' berichten gearchiveerd';
                break;

            case 'mark_read':
                $messages->update(['status' => 'read', 'is_read' => true]);
                $message = count($validated['message_ids']) . ' berichten gemarkeerd als gelezen';
                break;

            case 'mark_unread':
                $messages->update(['status' => 'new', 'is_read' => false]);
                $message = count($validated['message_ids']) . ' berichten gemarkeerd als ongelezen';
                break;
        }

        return back()->with('success', $message);
    }
}
