<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuoteRequestController extends Controller
{
    public function create()
    {
        $services = Service::where('is_active', true)
                          ->orderBy('order')
                          ->get();

        return view('quotes.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:20'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'service_id' => ['required', 'exists:services,id'],
            'description' => ['required', 'string', 'min:20'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:10'],
            'surface_area' => ['nullable', 'integer', 'min:1'],
            'preferred_date' => ['nullable', 'date', 'after:today'],
            'urgency' => ['required', 'in:low,normal,high'],
            'images' => ['nullable', 'array', 'max:5'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        if ($request->hasFile('images')) {
            $uploadedImages = [];
            foreach ($request->file('images') as $image) {
                $uploadedImages[] = $image->store('quotes', 'public');
            }
            $validated['images'] = $uploadedImages;
        }

        $validated['user_id'] = Auth::id();

        Quote::create($validated);

        return redirect()
            ->route('quote.success')
            ->with('success', 'Uw offerte aanvraag is succesvol verzonden! We nemen zo spoedig mogelijk contact met u op.');
    }

    public function success()
    {
        return view('quotes.success');
    }

    public function myQuotes()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $quotes = Quote::where('user_id', Auth::id())
                      ->with('service')
                      ->latest()
                      ->paginate(10);

        return view('quotes.my-quotes', compact('quotes'));
    }

    public function showMyQuote(Quote $quote)
    {
        if (!Auth::check() || $quote->user_id !== Auth::id()) {
            abort(403, 'U heeft geen toegang tot deze offerte.');
        }

        $quote->load(['service', 'comments' => function($query) {
            $query->where('is_internal', false);
        }]);

        return view('quotes.show', compact('quote'));
    }
}
