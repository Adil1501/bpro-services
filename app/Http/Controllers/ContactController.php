<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $validated['is_read'] = false;
        $validated['status'] = 'new';
        $validated['ip_address'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();

        ContactMessage::create($validated);

        return redirect()
            ->route('contact')
            ->with('success', 'Bedankt voor uw bericht! We nemen zo snel mogelijk contact met u op.');
    }
}
