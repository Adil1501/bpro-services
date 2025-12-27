@extends('frontend.layouts.app')

@section('title', 'Onze Diensten - B-Pro Services')
@section('description', 'Ontdek ons complete aanbod aan professionele schoonmaakdiensten voor bedrijven en particulieren.')

@section('content')

<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Onze Diensten
            </h1>
            <p class="text-xl text-blue-100">
                Professionele schoonmaakoplossingen voor elke situatie
            </p>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">

        @if($services->isEmpty())
            <div class="max-w-2xl mx-auto text-center py-12">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-concierge-bell text-gray-400 text-5xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Nog geen diensten beschikbaar</h2>
                <p class="text-gray-600 mb-6">We zijn bezig met het toevoegen van onze diensten. Kom later terug!</p>
                <a href="{{ route('contact') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Neem Contact Op
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <div class="bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden group">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-8 text-center relative overflow-hidden">
                            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity"></div>
                            <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4 transform group-hover:scale-110 transition-transform">
                                @if($service->icon)
                                    <i class="{{ $service->icon }} text-white text-4xl"></i>
                                @else
                                    <i class="fas fa-broom text-white text-4xl"></i>
                                @endif
                            </div>
                            <h3 class="text-2xl font-bold text-white">{{ $service->name }}</h3>
                        </div>

                        <div class="p-6">
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                {{ Str::limit($service->description, 150) }}
                            </p>

                            @if($service->features)
                                <div class="mb-6">
                                    <h4 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
                                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                        Omvat
                                    </h4>
                                    <ul class="space-y-2">
                                        @php
                                            $features = is_array($service->features) ? $service->features : explode(',', $service->features);
                                            $displayFeatures = array_slice($features, 0, 3);
                                        @endphp
                                        @foreach($displayFeatures as $feature)
                                            <li class="text-sm text-gray-600 flex items-start">
                                                <i class="fas fa-check text-blue-600 mr-2 mt-1 text-xs"></i>
                                                <span>{{ trim($feature) }}</span>
                                            </li>
                                        @endforeach
                                        @if(count($features) > 3)
                                            <li class="text-sm text-gray-500 italic">
                                                + {{ count($features) - 3 }} meer...
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            @endif

                            <div class="flex flex-col sm:flex-row gap-3">
                                <a href="{{ route('services.show', $service) }}"
                                   class="flex-1 text-center px-4 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Meer Info
                                </a>
                                <a href="{{ route('quote.create') }}?service={{ $service->id }}"
                                   class="flex-1 text-center px-4 py-3 border-2 border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition">
                                    <i class="fas fa-file-invoice mr-2"></i>
                                    Offerte
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl shadow-2xl p-12 text-center text-white">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Niet Gevonden Wat U Zoekt?
            </h2>
            <p class="text-xl text-blue-100 mb-8">
                We bieden ook maatwerk oplossingen aan. Neem contact met ons op voor een persoonlijk advies.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('quote.create') }}"
                   class="px-8 py-4 bg-white text-blue-600 rounded-lg font-bold hover:bg-blue-50 transition shadow-lg">
                    <i class="fas fa-file-invoice mr-2"></i>
                    Vraag Offerte Aan
                </a>
                <a href="{{ route('contact') }}"
                   class="px-8 py-4 border-2 border-white text-white rounded-lg font-bold hover:bg-white hover:text-blue-600 transition">
                    <i class="fas fa-phone mr-2"></i>
                    Bel Ons
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
