@extends('frontend.layouts.app')

@section('title', 'Offerte Aanvragen - B-Pro Services')

@section('content')

<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Vraag Een Gratis Offerte Aan
            </h1>
            <p class="text-xl text-blue-100">
                Vul onderstaand formulier in en ontvang binnen 24 uur een offerte op maat
            </p>
        </div>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">

            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center flex-1">
                        <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">
                            1
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-semibold text-gray-900">Dienst</p>
                            <p class="text-xs text-gray-500">Kies uw dienst</p>
                        </div>
                    </div>
                    <div class="flex-1 h-1 bg-gray-200 mx-4"></div>
                    <div class="flex items-center flex-1">
                        <div class="w-10 h-10 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center font-bold">
                            2
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-semibold text-gray-900">Gegevens</p>
                            <p class="text-xs text-gray-500">Uw contactinfo</p>
                        </div>
                    </div>
                    <div class="flex-1 h-1 bg-gray-200 mx-4"></div>
                    <div class="flex items-center flex-1">
                        <div class="w-10 h-10 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center font-bold">
                            3
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-semibold text-gray-900">Details</p>
                            <p class="text-xs text-gray-500">Extra informatie</p>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('quote.store') }}" method="POST" class="bg-white rounded-lg shadow-md p-8">
                @csrf

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm mr-3">1</span>
                    Welke dienst heeft u nodig?
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($services as $service)
                        <label class="relative cursor-pointer block">
                            <input type="radio"
                                name="service_id"
                                value="{{ $service->id }}"
                                {{ old('service_id', $selectedServiceId ?? '') == $service->id ? 'checked' : '' }}
                                class="absolute opacity-0 peer"
                                required>
                            <div class="border-2 border-gray-200 rounded-lg p-4 peer-checked:border-blue-600 peer-checked:bg-blue-50 hover:border-blue-300 transition-all duration-200 h-full">
                                <div class="flex items-start">
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        @if($service->icon)
                                            <i class="{{ $service->icon }} text-blue-600 text-xl"></i>
                                        @else
                                            <i class="fas fa-concierge-bell text-blue-600 text-xl"></i>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-semibold text-gray-900 mb-1 flex items-center justify-between">
                                            {{ $service->name }}
                                            <i class="fas fa-check-circle text-blue-600 text-xl opacity-0 peer-checked:opacity-100 ml-2 transition-opacity"></i>
                                        </h3>
                                        <p class="text-sm text-gray-600 leading-tight">{{ Str::limit($service->description, 80) }}</p>
                                    </div>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('service_id')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

                <div class="mb-8 border-t pt-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <span class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm mr-3">2</span>
                        Uw contactgegevens
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Naam <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                   placeholder="Jan Janssen"
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                                   placeholder="jan@voorbeeld.be"
                                   required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Telefoonnummer <span class="text-red-500">*</span>
                            </label>
                            <input type="tel"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('phone') border-red-500 @enderror"
                                   placeholder="+32 471 23 45 67"
                                   required>
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Bedrijfsnaam (optioneel)
                            </label>
                            <input type="text"
                                   name="company_name"
                                   value="{{ old('company_name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Mijn Bedrijf BV">
                        </div>
                    </div>
                </div>

                <div class="mb-8 border-t pt-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <span class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm mr-3">3</span>
                        Project details
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Adres <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="address"
                                   value="{{ old('address') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('address') border-red-500 @enderror"
                                   placeholder="Straatnaam 123"
                                   required>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Stad
                            </label>
                            <input type="text"
                                   name="city"
                                   value="{{ old('city') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Leuven">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Postcode
                            </label>
                            <input type="text"
                                   name="postal_code"
                                   value="{{ old('postal_code') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="3000">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Oppervlakte (m²)
                            </label>
                            <input type="number"
                                   name="surface_area"
                                   value="{{ old('surface_area') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="150"
                                   min="1">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Gewenste startdatum
                            </label>
                            <input type="date"
                                   name="preferred_date"
                                   value="{{ old('preferred_date') }}"
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Urgentie <span class="text-red-500">*</span>
                            </label>
                            <select name="urgency"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required>
                                <option value="low" {{ old('urgency') == 'low' ? 'selected' : '' }}>Laag - Binnen 2 weken</option>
                                <option value="normal" {{ old('urgency', 'normal') == 'normal' ? 'selected' : '' }}>Normaal - Binnen 1 week</option>
                                <option value="high" {{ old('urgency') == 'high' ? 'selected' : '' }}>Hoog - Zo snel mogelijk</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Extra informatie <span class="text-red-500">*</span>
                        </label>
                        <textarea name="message"
                                  rows="5"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('message') border-red-500 @enderror"
                                  placeholder="Beschrijf uw wensen en eventuele specifieke eisen..."
                                  required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            Hoe meer details u geeft, hoe beter we uw offerte kunnen opstellen
                        </p>
                    </div>
                </div>

                <div class="border-t pt-6">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-shield-alt text-green-600 mr-1"></i>
                            Uw gegevens worden veilig verwerkt
                        </p>
                        <button type="submit"
                                class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Verstuur Offerte Aanvraag
                        </button>
                    </div>
                </div>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Snelle Reactie</h3>
                    <p class="text-sm text-gray-600">Binnen 24 uur reactie op uw aanvraag</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-euro-sign text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Gratis Offerte</h3>
                    <p class="text-sm text-gray-600">Vrijblijvend en geheel kosteloos</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-star text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Op Maat</h3>
                    <p class="text-sm text-gray-600">Persoonlijk advies voor uw situatie</p>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    input[type="radio"]:checked + div {
        animation: pulse 0.3s ease-in-out;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.02); }
        100% { transform: scale(1); }
    }


    label:hover .fa-check-circle {
        opacity: 0.3 !important;
    }

    input[type="radio"]:checked ~ div .fa-check-circle {
        opacity: 1 !important;
    }
</style>
@endpush

@endsection
