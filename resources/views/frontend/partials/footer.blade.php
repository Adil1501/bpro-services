<footer class="bg-gray-900 text-gray-300">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            <div>
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-broom text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white">B-Pro Services</h3>
                </div>
                <p class="text-gray-400 mb-4">
                    Professionele schoonmaakdiensten voor bedrijven en particulieren.
                </p>
                <div class="flex space-x-4">
                    @if($facebook = setting('social_facebook'))
                        <a href="{{ $facebook }}" target="_blank" class="text-gray-400 hover:text-blue-500 transition">
                            <i class="fab fa-facebook text-2xl"></i>
                        </a>
                    @endif
                    @if($instagram = setting('social_instagram'))
                        <a href="{{ $instagram }}" target="_blank" class="text-gray-400 hover:text-pink-500 transition">
                            <i class="fab fa-instagram text-2xl"></i>
                        </a>
                    @endif
                    @if($linkedin = setting('social_linkedin'))
                        <a href="{{ $linkedin }}" target="_blank" class="text-gray-400 hover:text-blue-400 transition">
                            <i class="fab fa-linkedin text-2xl"></i>
                        </a>
                    @endif
                </div>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Snelle Links</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-400 transition">Home</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-blue-400 transition">Diensten</a></li>
                    <li><a href="{{ route('portfolio') }}" class="hover:text-blue-400 transition">Portfolio</a></li>
                    <li><a href="{{ route('news.index') }}" class="hover:text-blue-400 transition">Nieuws</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-blue-400 transition">FAQ</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-blue-400 transition">Contact</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Onze Diensten</h4>
                <ul class="space-y-2">
                    @foreach(\App\Models\Service::where('is_active', true)->orderBy('order')->take(5)->get() as $service)
                        <li>
                            <a href="{{ route('services.show', $service) }}" class="hover:text-blue-400 transition">
                                <i class="{{ $service->icon }} mr-2"></i>{{ $service->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Contact</h4>
                <ul class="space-y-3">
                    @if($email = setting('contact_email'))
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3 text-blue-400"></i>
                            <a href="mailto:{{ $email }}" class="hover:text-blue-400 transition">
                                {{ $email }}
                            </a>
                        </li>
                    @endif

                    @if($phone = setting('contact_phone'))
                        <li class="flex items-start">
                            <i class="fas fa-phone mt-1 mr-3 text-blue-400"></i>
                            <a href="tel:{{ $phone }}" class="hover:text-blue-400 transition">
                                {{ $phone }}
                            </a>
                        </li>
                    @endif

                    @if($address = setting('contact_address'))
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-blue-400"></i>
                            <span>
                                {{ $address }}<br>
                                {{ setting('contact_postal_code') }} {{ setting('contact_city') }}
                            </span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-8">
            <div class="flex flex-col items-center justify-center text-center">

                <div class="flex flex-wrap justify-center gap-4 mb-3">
                    @php
                        try {
                            $vat = function_exists('setting') ? setting('business_vat') : \App\Models\Setting::get('business_vat');
                            $kvk = function_exists('setting') ? setting('business_kvk') : \App\Models\Setting::get('business_kvk');
                        } catch (\Exception $e) {
                            $vat = $kvk = null;
                        }
                    @endphp

                    @if($vat)
                        <span class="text-gray-500 text-sm">BTW: {{ $vat }}</span>
                    @endif
                    @if($ondnr)
                        <span class="text-gray-500 text-sm">Ondernemingsnummer: {{ $ondnr }}</span>
                    @endif
                </div>

                <p class="text-gray-400 text-sm">
                    &copy; {{ date('Y') }} B-Pro Services. Alle rechten voorbehouden.
                </p>
            </div>
        </div>
    </div>
</footer>
