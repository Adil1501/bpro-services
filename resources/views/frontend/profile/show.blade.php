@extends('frontend.layouts.app')

@section('title', $user->display_name . ' - Profiel')

@section('content')

<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="relative">
                    <img src="{{ $user->profile_photo_url }}"
                         alt="{{ $user->name }}"
                         class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-xl">
                    @if($user->isAdmin())
                        <div class="absolute -bottom-2 -right-2 bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                            <i class="fas fa-crown mr-1"></i>Admin
                        </div>
                    @endif
                </div>

                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-4xl font-bold mb-2">{{ $user->name }}</h1>

                    @if($user->username)
                        <p class="text-blue-200 text-lg mb-4">
                            <span class="opacity-70">@</span>{{ $user->username }}
                        </p>
                    @endif

                    <div class="flex flex-wrap gap-4 justify-center md:justify-start text-blue-100">
                        @if($user->birthday)
                            <span class="flex items-center">
                                <i class="fas fa-birthday-cake mr-2"></i>
                                {{ $user->birthday->format('d F Y') }}
                                @if($user->age)
                                    ({{ $user->age }} jaar)
                                @endif
                            </span>
                        @endif

                        <span class="flex items-center">
                            <i class="fas fa-calendar mr-2"></i>
                            Lid sinds {{ $user->created_at->format('F Y') }}
                        </span>
                    </div>

                    @auth
                        @if(auth()->id() === $user->id)
                            <div class="mt-4">
                                <a href="{{ route('profile.edit') }}"
                                   class="inline-flex items-center px-6 py-3 bg-white text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition shadow-md">
                                    <i class="fas fa-edit mr-2"></i>
                                    Profiel Bewerken
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">

            @if($user->bio)
                <div class="bg-white rounded-xl shadow-md p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-user text-blue-600 mr-3"></i>
                        Over Mij
                    </h2>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $user->bio }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-file-invoice text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $user->quotes()->count() }}</h3>
                    <p class="text-gray-600">Offertes</p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-heart text-pink-600 text-2xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $user->likedProjects()->count() }}</h3>
                    <p class="text-gray-600">Likes</p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ round($user->created_at->diffInDays(now())) }}</h3>
                    <p class="text-gray-600">Dagen Actief</p>
                </div>
            </div>

            @if($user->quotes()->exists())
                <div class="bg-white rounded-xl shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-history text-blue-600 mr-3"></i>
                        Recente Activiteit
                    </h2>

                    <div class="space-y-4">
                        @foreach($user->quotes()->latest()->take(5)->get() as $quote)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="{{ $quote->service->icon ?? 'fas fa-file-invoice' }} text-blue-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">
                                            Offerte voor {{ $quote->service->name ?? 'Dienst' }}
                                        </h4>
                                        <p class="text-sm text-gray-600">
                                            {{ $quote->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>

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

                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$quote->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusLabels[$quote->status] ?? ucfirst($quote->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(!$user->bio && !$user->quotes()->exists())
                <div class="bg-white rounded-xl shadow-md p-12 text-center">
                    <i class="fas fa-user-circle text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Dit profiel is nog leeg</h3>
                    <p class="text-gray-600">
                        @auth
                            @if(auth()->id() === $user->id)
                                Voeg wat informatie toe aan je profiel!
                            @else
                                {{ $user->name }} heeft nog geen informatie toegevoegd.
                            @endif
                        @else
                            {{ $user->name }} heeft nog geen informatie toegevoegd.
                        @endauth
                    </p>
                </div>
            @endif

        </div>
    </div>
</section>

@endsection
