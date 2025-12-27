@extends('frontend.layouts.app')

@section('title', 'Bedankt voor uw aanvraag!')

@section('content')

<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center">

            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce">
                <i class="fas fa-check text-green-600 text-5xl"></i>
            </div>

            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                Bedankt Voor Uw Aanvraag!
            </h1>
            <p class="text-xl text-gray-600 mb-8">
                Wij hebben uw offerte aanvraag goed ontvangen en zullen deze zo spoedig mogelijk behandelen.
            </p>

            <div class="bg-white rounded-lg shadow-md p-8 mb-8 text-left">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-blue-600 mr-3"></i>
                    Wat gebeurt er nu?
                </h2>

                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-blue-600 font-bold">1</span>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-900">Binnen 24 uur</h3>
                            <p class="text-gray-600 text-sm">U ontvangt een eerste reactie op uw aanvraag</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-blue-600 font-bold">2</span>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-900">Persoonlijk Contact</h3>
                            <p class="text-gray-600 text-sm">We nemen telefonisch of per email contact met u op</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-blue-600 font-bold">3</span>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-900">Offerte Op Maat</h3>
                            <p class="text-gray-600 text-sm">U ontvangt een vrijblijvende offerte</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($quote)
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
                    <p class="text-sm text-blue-800 mb-2">Uw referentienummer:</p>
                    <p class="text-2xl font-bold text-blue-900">#{{ str_pad($quote->id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>
            @endif

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}"
                   class="px-8 py-4 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                    <i class="fas fa-home mr-2"></i>
                    Terug naar Homepage
                </a>
                <a href="{{ route('services') }}"
                   class="px-8 py-4 bg-white text-blue-600 border-2 border-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition">
                    <i class="fas fa-concierge-bell mr-2"></i>
                    Bekijk Onze Diensten
                </a>
            </div>
        </div>
    </div>
</section>

<style>
@keyframes bounce {
    0%, 100% {
        transform: translateY(-25%);
        animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
    }
    50% {
        transform: translateY(0);
        animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
    }
}

.animate-bounce {
    animation: bounce 1s infinite;
}
</style>

@endsection
