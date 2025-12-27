@extends('frontend.layouts.app')

@section('title', 'Contact - B-Pro Services')
@section('description', 'Neem contact op met B-Pro Services. We staan klaar om uw vragen te beantwoorden.')

@section('content')

<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Neem Contact Op
            </h1>
            <p class="text-xl text-blue-100">
                Vragen? Opmerkingen? We helpen u graag verder!
            </p>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Stuur Ons Een Bericht</h2>

                    @if(session('success'))
                        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex items-start" role="alert">
                            <i class="fas fa-check-circle text-green-600 mr-3 mt-1"></i>
                            <div>
                                <strong class="font-bold">Bedankt!</strong>
                                <span class="block sm:inline ml-1">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
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
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Onderwerp <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="subject"
                                   value="{{ old('subject') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('subject') border-red-500 @enderror"
                                   placeholder="Waar gaat uw vraag over?"
                                   required>
                            @error('subject')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Bericht <span class="text-red-500">*</span>
                            </label>
                            <textarea name="message"
                                      rows="6"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('message') border-red-500 @enderror"
                                      placeholder="Typ hier uw bericht..."
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Maximaal 2000 karakters
                            </p>
                        </div>

                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-shield-alt text-green-600 mr-1"></i>
                                Uw gegevens worden veilig verwerkt
                            </p>
                            <button type="submit"
                                    class="px-8 py-4 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition shadow-md hover:shadow-lg">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Verstuur Bericht
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-1">

                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Contactgegevens</h3>

                    <div class="space-y-4">
                        @php
                            try {
                                $email = \App\Models\Setting::get('contact_email', 'info@bproservices.be');
                                $phone = \App\Models\Setting::get('contact_phone');
                                $address = \App\Models\Setting::get('contact_address');
                                $city = \App\Models\Setting::get('contact_city');
                                $postal = \App\Models\Setting::get('contact_postal_code');
                            } catch (\Exception $e) {
                                $email = 'info@bproservices.be';
                                $phone = $address = $city = $postal = null;
                            }
                        @endphp

                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-blue-600"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-900 mb-1">Email</h4>
                                <a href="mailto:{{ $email }}" class="text-blue-600 hover:underline">
                                    {{ $email }}
                                </a>
                            </div>
                        </div>

                        @if($phone)
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-phone text-green-600"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-900 mb-1">Telefoon</h4>
                                    <a href="tel:{{ $phone }}" class="text-blue-600 hover:underline">
                                        {{ $phone }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if($address)
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-purple-600"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-900 mb-1">Adres</h4>
                                    <p class="text-gray-600">
                                        {{ $address }}
                                        @if($postal && $city)
                                            <br>{{ $postal }} {{ $city }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-clock text-blue-600 mr-2"></i>
                        Openingstijden
                    </h3>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Maandag - Vrijdag</span>
                            <span class="font-semibold text-gray-900">8:00 - 18:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Zaterdag</span>
                            <span class="font-semibold text-gray-900">9:00 - 14:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Zondag</span>
                            <span class="font-semibold text-gray-900">Gesloten</span>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-xs text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            Spoedgevallen 24/7 bereikbaar
                        </p>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl shadow-md p-6 text-white">
                    <h3 class="text-lg font-bold mb-3">Liever Direct Contact?</h3>
                    <p class="text-blue-100 text-sm mb-4">
                        Vraag meteen een gratis offerte aan
                    </p>
                    <a href="{{ route('quote.create') }}"
                       class="block w-full bg-white text-blue-600 px-6 py-3 rounded-lg font-bold text-center hover:bg-blue-50 transition">
                        <i class="fas fa-file-invoice mr-2"></i>
                        Offerte Aanvragen
                    </a>
                </div>

                @php
                    try {
                        $facebook = \App\Models\Setting::get('social_facebook');
                        $instagram = \App\Models\Setting::get('social_instagram');
                        $linkedin = \App\Models\Setting::get('social_linkedin');
                    } catch (\Exception $e) {
                        $facebook = $instagram = $linkedin = null;
                    }
                @endphp

                @if($facebook || $instagram || $linkedin)
                    <div class="bg-white rounded-xl shadow-md p-6 mt-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Volg Ons</h3>
                        <div class="flex gap-3">
                            @if($facebook)
                                <a href="{{ $facebook }}" target="_blank"
                                   class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center hover:bg-blue-600 hover:text-white transition group">
                                    <i class="fab fa-facebook text-blue-600 group-hover:text-white text-xl"></i>
                                </a>
                            @endif

                            @if($instagram)
                                <a href="{{ $instagram }}" target="_blank"
                                   class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center hover:bg-pink-600 hover:text-white transition group">
                                    <i class="fab fa-instagram text-pink-600 group-hover:text-white text-xl"></i>
                                </a>
                            @endif

                            @if($linkedin)
                                <a href="{{ $linkedin }}" target="_blank"
                                   class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center hover:bg-blue-700 hover:text-white transition group">
                                    <i class="fab fa-linkedin text-blue-700 group-hover:text-white text-xl"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="py-0">
    <div class="w-full h-96 bg-gray-200">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2519.8999514399984!2d4.354869876477412!3d50.83301707166781!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3c489ee826df3%3A0xcc9ad57f2e20d678!2sAv.%20Louise%2065%2C%201000%20Bruxelles!5e0!3m2!1sfr!2sbe!4v1766847486168!5m2!1sfr!2sbe"
            width="100%"
            height="100%"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            class="grayscale hover:grayscale-0 transition duration-300">
        </iframe>
    </div>
</section>
@endsection
