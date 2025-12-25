<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\QuoteComment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class QuoteController extends Controller
{
    public function index(Request $request)
    {
        $query = Quote::with(['service', 'user', 'assignedTo']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('urgency')) {
            $query->where('urgency', $request->urgency);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('company_name', 'like', "%{$search}%");
            });
        }

        $quotes = $query->latest()->paginate(20);

        $stats = [
            'total' => Quote::count(),
            'new' => Quote::where('status', 'pending')->count(),
            'in_progress' => Quote::where('status', 'reviewed')->count(),
            'quoted' => Quote::where('status', 'approved')->count(),
        ];

        return view('admin.quotes.index', compact('quotes', 'stats'));
    }

    public function show(Quote $quote)
    {
        $quote->load(['service', 'user', 'assignedTo', 'comments.user']);

        $admins = User::where('role', 'admin')->get();

        return view('admin.quotes.show', compact('quote', 'admins'));
    }

    public function updateStatus(Request $request, Quote $quote)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,reviewed,approved,rejected'],
        ]);

        $quote->update($validated);

        QuoteComment::create([
            'quote_id' => $quote->id,
            'user_id' => Auth::id(),
            'comment' => "Status gewijzigd naar: " . $quote->status_label,
            'is_internal' => true,
        ]);

        return back()->with('success', 'Status bijgewerkt naar: ' . $quote->status_label);
    }

    public function assign(Request $request, Quote $quote)
    {
        $validated = $request->validate([
            'assigned_to' => ['nullable', 'exists:users,id'],
        ]);

        $assignedTo = $validated['assigned_to'] ?? null;

        $quote->update(['assigned_to' => $assignedTo]);

        if ($assignedTo) {
            $assignedUser = User::find($assignedTo);
            QuoteComment::create([
                'quote_id' => $quote->id,
                'user_id' => Auth::id(),
                'comment' => "Toegewezen aan: " . $assignedUser->name,
                'is_internal' => true,
            ]);

            return back()->with('success', 'Offerte toegewezen aan ' . $assignedUser->name);
        } else {
            QuoteComment::create([
                'quote_id' => $quote->id,
                'user_id' => Auth::id(),
                'comment' => "Toewijzing verwijderd (niemand toegewezen)",
                'is_internal' => true,
            ]);

            return back()->with('success', 'Toewijzing verwijderd');
        }
    }

    public function updateQuote(Request $request, Quote $quote)
    {
        $validated = $request->validate([
            'quoted_price' => ['nullable', 'numeric', 'min:0'],
            'quote_details' => ['nullable', 'string'],
            'quote_valid_until' => ['nullable', 'date'],
            'admin_notes' => ['nullable', 'string'],
        ]);

        $quote->update($validated);

        return back()->with('success', 'Offerte details bijgewerkt!');
    }

    public function addComment(Request $request, Quote $quote)
    {
        $validated = $request->validate([
            'comment' => ['required', 'string'],
            'is_internal' => ['boolean'],
        ]);

        QuoteComment::create([
            'quote_id' => $quote->id,
            'user_id' => Auth::id(),
            'comment' => $validated['comment'],
            'is_internal' => $validated['is_internal'] ?? true,
        ]);

        return back()->with('success', 'Opmerking toegevoegd!');
    }

    public function sendQuote(Request $request, Quote $quote)
    {
        $validated = $request->validate([
            'email_subject' => ['required', 'string', 'max:255'],
            'email_body' => ['required', 'string'],
        ]);

        $quote->update(['status' => 'quoted']);

        QuoteComment::create([
            'quote_id' => $quote->id,
            'user_id' => Auth::id(),
            'comment' => "Offerte verzonden naar klant via email",
            'is_internal' => true,
        ]);

        return back()->with('success', 'Offerte verzonden naar ' . $quote->customer_email);
    }

    public function destroy(Quote $quote)
    {
        if ($quote->images) {
            foreach ($quote->images as $image) {
                \Storage::disk('public')->delete($image);
            }
        }

        $quote->delete();

        return redirect()
            ->route('admin.quotes.index')
            ->with('success', 'Offerte aanvraag verwijderd!');
    }

    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'quote_ids' => ['required', 'array'],
            'quote_ids.*' => ['exists:quotes,id'],
            'action' => ['required', 'in:delete,mark_completed,assign'],
            'assigned_to' => ['required_if:action,assign', 'exists:users,id'],
        ]);

        $quotes = Quote::whereIn('id', $validated['quote_ids']);

        switch ($validated['action']) {
            case 'delete':
                $quotes->delete();
                $message = count($validated['quote_ids']) . ' quotes verwijderd';
                break;

            case 'mark_completed':
                $quotes->update(['status' => 'completed']);
                $message = count($validated['quote_ids']) . ' quotes gemarkeerd als afgerond';
                break;

            case 'assign':
                $quotes->update(['assigned_to' => $validated['assigned_to']]);
                $assignedUser = User::find($validated['assigned_to']);
                $message = count($validated['quote_ids']) . ' quotes toegewezen aan ' . $assignedUser->name;
                break;
        }

        return back()->with('success', $message);
    }
}
