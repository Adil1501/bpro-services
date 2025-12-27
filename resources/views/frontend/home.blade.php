@extends('frontend.layouts.app')

@section('title', 'B-Pro Services - Professionele Schoonmaakdiensten')

@section('content')

<section class="relative bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute transform rotate-45 bg-blue-400 w-96 h-96 -top-48 -right-48 rounded-full"></div>
        <div class="absolute transform -rotate-45 bg-blue-400 w-96 h-96 -bottom-48 -left-48 rounded-full"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl">
            <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                Professionele Schoonmaakdiensten
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-blue-100">
                Voor bedrijven en particulieren in België. Kwaliteit en betrouwbaarheid gegarandeerd.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('quote.create') }}"
                   class="bg-white text-blue-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-blue-50 transition shadow-lg hover:shadow-xl transform hover:-translate-y-1 text-center">
                    <i class="fas fa-file-invoice mr-2"></i>
                    Gratis Offerte Aanvragen
                </a>
                <a href="{{ route('services') }}"
                   class="border-2 border-white text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-white hover:text-blue-600 transition text-center">
                    <i class="fas fa-concierge-bell mr-2"></i>
                    Bekijk Onze Diensten
                </a>
            </div>
        </div>
    </div>
</section>

<section class="py-12 bg-white border-b">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-4xl font-bold text-blue-600 mb-2">500+</div>
                <div class="text-gray-600">Tevreden Klanten</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-blue-600 mb-2">{{ \App\Models\Portfolio::count() }}+</div>
                <div class="text-gray-600">Projecten Afgerond</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-blue-600 mb-2">10+</div>
                <div class="text-gray-600">Jaar Ervaring</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-blue-600 mb-2">100%</div>
                <div class="text-gray-600">Tevredenheidsgarantie</div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Onze Diensten</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Wij bieden een breed scala aan professionele schoonmaakdiensten
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach(\App\Models\Service::where('is_active', true)->orderBy('order')->take(6)->get() as $service)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-8 group">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-blue-600 transition">
                        <i class="{{ $service->icon }} text-3xl text-blue-600 group-hover:text-white transition"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $service->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($service->description, 120) }}</p>
                    <a href="{{ route('services.show', $service) }}"
                       class="text-blue-600 font-semibold hover:text-blue-800 transition">
                        Meer info <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('services') }}"
               class="inline-block bg-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-700 transition shadow-md">
                Bekijk Alle Diensten <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Ons Recente Werk</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Bekijk onze succesverhalen en voor/na transformaties
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach(\App\Models\Portfolio::latest()->take(6)->get() as $project)
                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-xl shadow-md aspect-video">
                        <img src="{{ Storage::url($project->image_before) }}"
                             alt="{{ $project->title }}"
                             class="w-full h-full object-cover transition duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition flex items-end p-6">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-1">{{ $project->title }}</h3>
                                <p class="text-sm">{{ $project->category->name }}</p>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4 bg-white px-3 py-1 rounded-full text-sm font-semibold text-gray-900">
                            Voor/Na
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('portfolio') }}"
               class="inline-block bg-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-700 transition shadow-md">
                Bekijk Volledig Portfolio <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<section class="py-20 bg-gradient-to-r from-blue-600 to-blue-800 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">Klaar Om Te Beginnen?</h2>
        <p class="text-xl mb-8 text-blue-100 max-w-2xl mx-auto">
            Vraag vandaag nog een gratis offerte aan en ontdek wat wij voor u kunnen betekenen
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('quote.create') }}"
               class="bg-white text-blue-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-blue-50 transition shadow-lg">
                <i class="fas fa-file-invoice mr-2"></i>
                Gratis Offerte
            </a>
            <a href="{{ route('contact') }}"
               class="border-2 border-white text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-white hover:text-blue-600 transition">
                <i class="fas fa-phone mr-2"></i>
                Neem Contact Op
            </a>
        </div>
    </div>
</section>

@endsection
