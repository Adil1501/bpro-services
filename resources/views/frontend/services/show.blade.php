@extends('frontend.layouts.app')

@section('title', $service->name . ' - B-Pro Services')
@section('description', Str::limit($service->description, 160))

@section('content')

<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <nav class="mb-6">
                <ol class="flex items-center space-x-2 text-sm text-blue-200">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li><a href="{{ route('services') }}" class="hover:text-white transition">Diensten</a></li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-white">{{ $service->name }}</li>
                </ol>
            </nav>

            <div class="flex items-start gap-6">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-xl flex items-center justify-center flex-shrink-0">
                    @if($service->icon)
                        <i class="{{ $service->icon }} text-white text-4xl"></i>
                    @else
                        <i class="fas fa-broom text-white text-4xl"></i>
                    @endif
                </div>

                <div class="flex-1">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">
                        {{ $service->name }}
                    </h1>
                    <p class="text-xl text-blue-100">
                        {{ $service->short_description ?? Str::limit($service->description, 120) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-md p-8 mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Over Deze Dienst</h2>
                        <div class="prose prose-blue max-w-none text-gray-600 leading-relaxed">
                            {!! nl2br(e($service->description)) !!}
                        </div>
                    </div>

                    @if($service->features)
                        <div class="bg-white rounded-xl shadow-md p-8 mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                <i class="fas fa-list-check text-blue-600 mr-3"></i>
                                Wat Is Inbegrepen?
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @php
                                    $features = is_array($service->features) ? $service->features : explode(',', $service->features);
                                @endphp
                                @foreach($features as $feature)
                                    <div class="flex items-start">
                                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <i class="fas fa-check text-green-600 text-xs"></i>
                                        </div>
                                        <span class="ml-3 text-gray-700">{{ trim($feature) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="bg-white rounded-xl shadow-md p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-route text-blue-600 mr-3"></i>
                            Hoe Werkt Het?
                        </h2>
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-blue-600 font-bold text-lg">1</span>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="font-semibold text-gray-900 mb-1">Offerte Aanvragen</h3>
                                    <p class="text-gray-600 text-sm">Vul het offerteformulier in met uw wensen en gegevens</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-blue-600 font-bold text-lg">2</span>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="font-semibold text-gray-900 mb-1">Persoonlijk Contact</h3>
                                    <p class="text-gray-600 text-sm">Wij nemen binnen 24 uur contact met u op voor overleg</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-blue-600 font-bold text-lg">3</span>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="font-semibold text-gray-900 mb-1">Offerte Op Maat</h3>
                                    <p class="text-gray-600 text-sm">U ontvangt een vrijblijvende offerte aangepast aan uw situatie</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-blue-600 font-bold text-lg">4</span>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="font-semibold text-gray-900 mb-1">Planning & Uitvoering</h3>
                                    <p class="text-gray-600 text-sm">We plannen de werkzaamheden op een geschikt moment</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl shadow-xl p-6 text-white sticky top-4">
                        <h3 class="text-2xl font-bold mb-4">Interesse?</h3>
                        <p class="text-blue-100 mb-6">
                            Vraag een vrijblijvende offerte aan en ontvang binnen 24 uur een reactie.
                        </p>

                        <a href="{{ route('quote.create') }}?service={{ $service->id }}"
                           class="block w-full bg-white text-blue-600 px-6 py-4 rounded-lg font-bold text-center hover:bg-blue-50 transition shadow-lg mb-3">
                            <i class="fas fa-file-invoice mr-2"></i>
                            Vraag Offerte Aan
                        </a>

                        <a href="{{ route('contact') }}"
                           class="block w-full border-2 border-white text-white px-6 py-4 rounded-lg font-bold text-center hover:bg-white hover:text-blue-600 transition">
                            <i class="fas fa-phone mr-2"></i>
                            Bel Ons Direct
                        </a>

                        <div class="mt-6 pt-6 border-t border-blue-500">
                            <div class="space-y-3 text-sm">
                                <div class="flex items-center">
                                    <i class="fas fa-clock text-blue-200 mr-3"></i>
                                    <span>24/7 bereikbaar</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-euro-sign text-blue-200 mr-3"></i>
                                    <span>Gratis offerte</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-shield-alt text-blue-200 mr-3"></i>
                                    <span>100% garantie</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        $otherServices = \App\Models\Service::where('is_active', true)
                            ->where('id', '!=', $service->id)
                            ->orderBy('order')
                            ->take(3)
                            ->get();
                    @endphp

                    @if($otherServices->isNotEmpty())
                        <div class="bg-white rounded-xl shadow-md p-6 mt-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Andere Diensten</h3>
                            <div class="space-y-3">
                                @foreach($otherServices as $otherService)
                                    <a href="{{ route('services.show', $otherService) }}"
                                       class="block p-3 rounded-lg hover:bg-gray-50 transition group">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-blue-600 transition">
                                                @if($otherService->icon)
                                                    <i class="{{ $otherService->icon }} text-blue-600 group-hover:text-white transition"></i>
                                                @else
                                                    <i class="fas fa-broom text-blue-600 group-hover:text-white transition"></i>
                                                @endif
                                            </div>
                                            <div class="ml-3 flex-1">
                                                <h4 class="font-semibold text-gray-900 text-sm group-hover:text-blue-600 transition">
                                                    {{ $otherService->name }}
                                                </h4>
                                                <p class="text-xs text-gray-500">{{ Str::limit($otherService->description, 50) }}</p>
                                            </div>
                                            <i class="fas fa-chevron-right text-gray-400 group-hover:text-blue-600 transition"></i>
                                        </div>
                                    </a>
                                @endforeach
                            </div>

                            <a href="{{ route('services') }}"
                               class="block mt-4 text-center text-blue-600 font-semibold text-sm hover:text-blue-800 transition">
                                Bekijk Alle Diensten <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
