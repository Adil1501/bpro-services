@extends('frontend.layouts.app')

@section('title', 'Mijn Dashboard - B-Pro Services')

@section('content')

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">

            <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl shadow-lg p-8 mb-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Welkom terug, {{ auth()->user()->name }}! 👋</h1>
                        <p class="text-blue-100">Beheer hier uw offertes en accountgegevens</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-4xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                @php
                    $myQuotesCount = \App\Models\Quote::where('user_id', auth()->id())->count();
                    $pendingQuotes = \App\Models\Quote::where('user_id', auth()->id())->where('status', 'pending')->count();
                @endphp

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Mijn Offertes</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ $myQuotesCount }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-file-invoice text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">In Behandeling</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ $pendingQuotes }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clock text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Account Type</p>
                            <h3 class="text-xl font-bold text-gray-900 mt-1">{{ auth()->user()->isAdmin() ? 'Admin' : 'Klant' }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user-check text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <a href="{{ route('quote.create') }}"
                   class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition group text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-600 transition">
                        <i class="fas fa-plus text-blue-600 group-hover:text-white text-2xl transition"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Nieuwe Offerte</h3>
                    <p class="text-gray-600 text-sm">Vraag een nieuwe offerte aan</p>
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition group text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-600 transition">
                        <i class="fas fa-user-cog text-green-600 group-hover:text-white text-2xl transition"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Mijn Profiel</h3>
                    <p class="text-gray-600 text-sm">Beheer uw accountgegevens</p>
                </a>

                <a href="{{ route('contact') }}"
                   class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition group text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-600 transition">
                        <i class="fas fa-headset text-purple-600 group-hover:text-white text-2xl transition"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Contact</h3>
                    <p class="text-gray-600 text-sm">Neem contact met ons op</p>
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-md p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Mijn Offertes</h2>
                    <a href="{{ route('quote.create') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                        + Nieuwe Offerte
                    </a>
                </div>

                @php
                    $myQuotes = \App\Models\Quote::where('user_id', auth()->id())
                                                  ->latest()
                                                  ->take(5)
                                                  ->get();
                @endphp

                @if($myQuotes->isEmpty())
                    <div class="text-center py-12 text-gray-500">
                        <i class="fas fa-inbox text-6xl mb-4 text-gray-300"></i>
                        <p class="text-lg font-semibold mb-2">Nog geen offertes</p>
                        <p class="text-sm mb-4">U heeft nog geen offertes aangevraagd</p>
                        <a href="{{ route('quote.create') }}"
                           class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                            <i class="fas fa-plus mr-2"></i>
                            Eerste Offerte Aanvragen
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Dienst
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Datum
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acties
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($myQuotes as $quote)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                                    <i class="{{ $quote->service->icon ?? 'fas fa-broom' }} text-blue-600"></i>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $quote->service->name ?? 'Dienst verwijderd' }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        #{{ str_pad($quote->id, 5, '0', STR_PAD_LEFT) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $quote->created_at->format('d/m/Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ $quote->created_at->format('H:i') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                                    'quoted' => 'bg-blue-100 text-blue-800',
                                                    'accepted' => 'bg-green-100 text-green-800',
                                                    'rejected' => 'bg-red-100 text-red-800',
                                                    'completed' => 'bg-purple-100 text-purple-800',
                                                ];
                                                $statusLabels = [
                                                    'pending' => 'In behandeling',
                                                    'quoted' => 'Offerte verstuurd',
                                                    'accepted' => 'Geaccepteerd',
                                                    'rejected' => 'Afgewezen',
                                                    'completed' => 'Afgerond',
                                                ];
                                            @endphp
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$quote->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ $statusLabels[$quote->status] ?? ucfirst($quote->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button class="text-blue-600 hover:text-blue-900 mr-3">
                                                <i class="fas fa-eye mr-1"></i>Bekijken
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($myQuotesCount > 5)
                        <div class="mt-6 text-center">
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                                Bekijk alle {{ $myQuotesCount }} offertes <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </div>
</section>

@endsection
