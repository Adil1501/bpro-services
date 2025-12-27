<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuoteRequestController extends Controller
{
    public function create(Request $request)
    {
        $services = Service::where('is_active', true)
                        ->orderBy('order')
                        ->get();

        $selectedServiceId = $request->query('service');

        return view('frontend.quote.create', compact('services', 'selectedServiceId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'surface_area' => ['nullable', 'integer', 'min:1'],
            'preferred_date' => ['nullable', 'date', 'after:today'],
            'urgency' => ['required', 'in:low,normal,high'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $validated['user_id'] = auth()->id() ?? null;
        $validated['status'] = 'pending';

        $quote = Quote::create($validated);

        return redirect()
            ->route('quote.success')
            ->with('quote_id', $quote->id);
    }

    public function success()
    {
        if (!session('quote_id')) {
            return redirect()->route('home');
        }

        $quote = Quote::find(session('quote_id'));

        return view('frontend.quote.success', compact('quote'));
    }

    public function myQuotes()
    {
        $quotes = Quote::where('user_id', auth()->id())
                      ->latest()
                      ->paginate(10);

        return view('frontend.quote.my-quotes', compact('quotes'));
    }

    public function showMyQuote(Quote $quote)
    {
        if ($quote->user_id !== auth()->id()) {
            abort(403);
        }

        return view('frontend.quote.show', compact('quote'));
    }
}
