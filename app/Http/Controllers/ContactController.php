<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $contactMessage = ContactMessage::create($validated);

        try {
            Mail::to(config('mail.from.address'))
                ->send(new ContactFormMail($contactMessage));
        } catch (\Exception $e) {
            \Log::error('Failed to send contact form email: ' . $e->getMessage());
        }

        return redirect()
            ->route('contact')
            ->with('success', 'Bedankt voor uw bericht! We nemen zo snel mogelijk contact met u op.');
    }
}
