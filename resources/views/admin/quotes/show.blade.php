@extends('admin.layout')

@section('title', 'Offerte Details')
@section('page-title', 'Offerte #' . $quote->id . ' - ' . $quote->customer_name)

@section('content')

<div class="mb-4">
    <a href="{{ route('admin.quotes.index') }}" class="text-blue-600 hover:text-blue-900">
        <i class="fas fa-arrow-left mr-2"></i>Terug naar overzicht
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 space-y-6">

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-user text-blue-600 mr-2"></i>
                Klant Informatie
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-gray-500">Naam</label>
                    <p class="text-gray-900">{{ $quote->customer_name }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Email</label>
                    <p class="text-gray-900">
                        <a href="mailto:{{ $quote->customer_email }}" class="text-blue-600 hover:underline">
                            {{ $quote->customer_email }}
                        </a>
                    </p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Telefoon</label>
                    <p class="text-gray-900">
                        <a href="tel:{{ $quote->customer_phone }}" class="text-blue-600 hover:underline">
                            {{ $quote->customer_phone }}
                        </a>
                    </p>
                </div>
                @if($quote->company_name)
                    <div>
                        <label class="text-sm font-medium text-gray-500">Bedrijf</label>
                        <p class="text-gray-900">{{ $quote->company_name }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-briefcase text-blue-600 mr-2"></i>
                Dienst & Beschrijving
            </h3>

            <div class="mb-4">
                <label class="text-sm font-medium text-gray-500">Gevraagde Dienst</label>
                <p class="text-gray-900 font-semibold">{{ $quote->service->name ?? 'Geen dienst geselecteerd' }}</p>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-500">Beschrijving</label>
                <p class="text-gray-900 whitespace-pre-line">{{ $quote->description }}</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-map-marker-alt text-blue-600 mr-2"></i>
                Locatie & Details
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-gray-500">Adres</label>
                    <p class="text-gray-900">{{ $quote->address }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Stad</label>
                    <p class="text-gray-900">{{ $quote->city }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Postcode</label>
                    <p class="text-gray-900">{{ $quote->postal_code }}</p>
                </div>
                @if($quote->surface_area)
                    <div>
                        <label class="text-sm font-medium text-gray-500">Oppervlakte</label>
                        <p class="text-gray-900">{{ $quote->surface_area }} m²</p>
                    </div>
                @endif
                @if($quote->preferred_date)
                    <div>
                        <label class="text-sm font-medium text-gray-500">Gewenste Datum</label>
                        <p class="text-gray-900">{{ $quote->preferred_date->format('d/m/Y') }}</p>
                    </div>
                @endif
            </div>
        </div>

        @if($quote->images && count($quote->images) > 0)
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-images text-blue-600 mr-2"></i>
                    Foto's
                </h3>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($quote->images as $image)
                        <a href="{{ asset('storage/' . $image) }}" target="_blank" class="block">
                            <img src="{{ asset('storage/' . $image) }}"
                                 alt="Quote image"
                                 class="w-full h-32 object-cover rounded-lg border-2 border-gray-200 hover:border-blue-500 transition">
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-file-contract text-blue-600 mr-2"></i>
                Offerte Details
            </h3>

            <form action="{{ route('admin.quotes.update-quote', $quote) }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="quoted_price" class="block text-sm font-medium text-gray-700 mb-2">
                            Prijs (€)
                        </label>
                        <input type="number"
                               name="quoted_price"
                               id="quoted_price"
                               step="0.01"
                               value="{{ old('quoted_price', $quote->quoted_price) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                               placeholder="1250.00">
                    </div>

                    <div>
                        <label for="quote_valid_until" class="block text-sm font-medium text-gray-700 mb-2">
                            Geldig tot
                        </label>
                        <input type="date"
                               name="quote_valid_until"
                               id="quote_valid_until"
                               value="{{ old('quote_valid_until', $quote->quote_valid_until?->format('Y-m-d')) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="quote_details" class="block text-sm font-medium text-gray-700 mb-2">
                        Offerte Omschrijving
                    </label>
                    <textarea name="quote_details"
                              id="quote_details"
                              rows="4"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                              placeholder="Wat zit er in de offerte?">{{ old('quote_details', $quote->quote_details) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="admin_notes" class="block text-sm font-medium text-gray-700 mb-2">
                        Interne Notities
                    </label>
                    <textarea name="admin_notes"
                              id="admin_notes"
                              rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                              placeholder="Privé notities (niet zichtbaar voor klant)">{{ old('admin_notes', $quote->admin_notes) }}</textarea>
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i>Opslaan
                </button>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-comments text-blue-600 mr-2"></i>
                Opmerkingen
            </h3>

            <form action="{{ route('admin.quotes.add-comment', $quote) }}" method="POST" class="mb-6">
                @csrf
                <textarea name="comment"
                          rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-2"
                          placeholder="Voeg een opmerking toe..."
                          required></textarea>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_internal" value="1" checked class="rounded">
                        <span class="ml-2 text-sm text-gray-600">Interne opmerking (niet zichtbaar voor klant)</span>
                    </label>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fas fa-paper-plane mr-2"></i>Versturen
                    </button>
                </div>
            </form>

            <div class="space-y-4">
                @forelse($quote->comments as $comment)
                    <div class="border-l-4 {{ $comment->is_internal ? 'border-yellow-500 bg-yellow-50' : 'border-blue-500 bg-blue-50' }} p-4 rounded">
                        <div class="flex items-start justify-between mb-2">
                            <div class="flex items-center">
                                <i class="fas fa-user-circle text-2xl text-gray-400 mr-2"></i>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $comment->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $comment->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                            @if($comment->is_internal)
                                <span class="px-2 py-1 bg-yellow-200 text-yellow-800 text-xs font-semibold rounded">
                                    Intern
                                </span>
                            @endif
                        </div>
                        <p class="text-gray-700 whitespace-pre-line">{{ $comment->comment }}</p>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">Nog geen opmerkingen</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="space-y-6">

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Status</h3>

            <form action="{{ route('admin.quotes.update-status', $quote) }}" method="POST">
                @csrf
                <select name="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-3"
                        onchange="this.form.submit()">
                    <option value="pending" {{ $quote->status == 'pending' ? 'selected' : '' }}>Nieuw</option>
                    <option value="reviewed" {{ $quote->status == 'reviewed' ? 'selected' : '' }}>In Behandeling</option>
                    <option value="approved" {{ $quote->status == 'approved' ? 'selected' : '' }}>Goedgekeurd</option>
                    <option value="rejected" {{ $quote->status == 'rejected' ? 'selected' : '' }}>Afgewezen</option>
                </select>
            </form>

            <div class="text-center">
                <span class="inline-block px-4 py-2 text-sm font-semibold rounded-full {{ $quote->status_color }}">
                    {{ $quote->status_label }}
                </span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Toegewezen aan</h3>

            <form action="{{ route('admin.quotes.assign', $quote) }}" method="POST">
                @csrf
                <select name="assigned_to"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-3"
                        onchange="this.form.submit()">
                    <option value="">Niemand</option>
                    @foreach($admins as $admin)
                        <option value="{{ $admin->id }}" {{ $quote->assigned_to == $admin->id ? 'selected' : '' }}>
                            {{ $admin->name }}
                        </option>
                    @endforeach
                </select>
            </form>

            @if($quote->assignedTo)
                <p class="text-sm text-gray-600 text-center">
                    <i class="fas fa-user-check mr-1"></i>
                    {{ $quote->assignedTo->name }}
                </p>
            @endif
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Urgentie</h3>
            <div class="text-center">
                <span class="inline-block px-4 py-2 text-sm font-semibold rounded-full {{ $quote->urgency_color }}">
                    {{ ucfirst($quote->urgency) }}
                </span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Acties</h3>

            <div class="space-y-2">
                <a href="mailto:{{ $quote->customer_email }}"
                   class="block w-full px-4 py-2 bg-blue-600 text-white text-center rounded-lg hover:bg-blue-700">
                    <i class="fas fa-envelope mr-2"></i>Email Klant
                </a>

                <a href="tel:{{ $quote->customer_phone }}"
                   class="block w-full px-4 py-2 bg-green-600 text-white text-center rounded-lg hover:bg-green-700">
                    <i class="fas fa-phone mr-2"></i>Bel Klant
                </a>

                <form action="{{ route('admin.quotes.destroy', $quote) }}"
                      method="POST"
                      onsubmit="return confirm('Weet je zeker dat je deze offerte wilt verwijderen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        <i class="fas fa-trash mr-2"></i>Verwijderen
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informatie</h3>

            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Aangemaakt:</span>
                    <span class="text-gray-900">{{ $quote->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Laatste update:</span>
                    <span class="text-gray-900">{{ $quote->updated_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
