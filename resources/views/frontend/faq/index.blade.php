@extends('frontend.layouts.app')

@section('title', 'Veelgestelde Vragen (FAQ) - B-Pro Services')
@section('description', 'Vind antwoorden op veelgestelde vragen over onze schoonmaakdiensten')

@section('content')

<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Veelgestelde Vragen
            </h1>
            <p class="text-xl text-blue-100">
                Vind snel antwoorden op uw vragen over onze diensten
            </p>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">

            @if($categories->isEmpty())
                <div class="text-center py-12">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-question-circle text-gray-400 text-5xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Nog geen FAQ's beschikbaar</h2>
                    <p class="text-gray-600 mb-6">We zijn bezig met het toevoegen van veelgestelde vragen.</p>
                    <a href="{{ route('contact') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                        <i class="fas fa-envelope mr-2"></i>
                        Stel Uw Vraag
                    </a>
                </div>
            @else
                @foreach($categories as $category)
                    <div class="mb-12">
                        <div class="mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-folder text-blue-600"></i>
                                </div>
                                {{ $category->name }}
                            </h2>
                            @if($category->description)
                                <p class="text-gray-600 mt-2 ml-13">{{ $category->description }}</p>
                            @endif
                        </div>

                        <div class="space-y-4">
                            @foreach($category->faqs as $index => $faq)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden" x-data="{ open: false }">
                                    <button @click="open = !open"
                                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition focus:outline-none">
                                        <div class="flex items-start flex-1">
                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0 mt-1">
                                                <span class="text-blue-600 font-bold text-sm">{{ $index + 1 }}</span>
                                            </div>
                                            <span class="font-semibold text-gray-900 text-lg pr-8">{{ $faq->question }}</span>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-chevron-down text-blue-600 transition-transform transform"
                                               :class="{ 'rotate-180': open }"></i>
                                        </div>
                                    </button>

                                    <div x-show="open"
                                         x-collapse
                                         class="border-t border-gray-200">
                                        <div class="px-6 py-4 bg-gray-50">
                                            <div class="ml-12 text-gray-700 leading-relaxed">
                                                {!! nl2br(e($faq->answer)) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="mt-12 bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl shadow-xl p-8 md:p-12 text-center text-white">
                <h2 class="text-3xl font-bold mb-4">Vraag Niet Gevonden?</h2>
                <p class="text-xl text-blue-100 mb-8">
                    Geen probleem! Neem contact met ons op en we helpen u graag verder.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('contact') }}"
                       class="px-8 py-4 bg-white text-blue-600 rounded-lg font-bold hover:bg-blue-50 transition shadow-lg">
                        <i class="fas fa-envelope mr-2"></i>
                        Stuur Een Bericht
                    </a>
                    <a href="{{ route('quote.create') }}"
                       class="px-8 py-4 border-2 border-white text-white rounded-lg font-bold hover:bg-white hover:text-blue-600 transition">
                        <i class="fas fa-file-invoice mr-2"></i>
                        Vraag Offerte Aan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Snelle Links</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <a href="{{ route('services') }}"
                   class="bg-gray-50 rounded-xl p-6 text-center hover:shadow-lg transition group">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-600 transition">
                        <i class="fas fa-concierge-bell text-blue-600 group-hover:text-white text-2xl transition"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Onze Diensten</h3>
                    <p class="text-gray-600 text-sm">Bekijk ons complete dienstenaanbod</p>
                </a>

                <a href="{{ route('portfolio') }}"
                   class="bg-gray-50 rounded-xl p-6 text-center hover:shadow-lg transition group">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-600 transition">
                        <i class="fas fa-images text-purple-600 group-hover:text-white text-2xl transition"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Portfolio</h3>
                    <p class="text-gray-600 text-sm">Bekijk onze afgeronde projecten</p>
                </a>

                <a href="{{ route('news.index') }}"
                   class="bg-gray-50 rounded-xl p-6 text-center hover:shadow-lg transition group">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-600 transition">
                        <i class="fas fa-newspaper text-green-600 group-hover:text-white text-2xl transition"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Nieuws</h3>
                    <p class="text-gray-600 text-sm">Blijf op de hoogte van updates</p>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
