@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="bg-gradient-to-r from-blue-500 to-blue-700 rounded-lg shadow-lg p-6 mb-6 text-white">
    <h2 class="text-2xl font-bold mb-2">Welkom terug, {{ auth()->user()->name }}! 👋</h2>
    <p class="text-blue-100">Hier is een overzicht van je B-Pro Services Admin Panel</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-gray-500 text-sm font-medium">Gebruikers</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['users'] }}</h3>
            </div>
            <div class="p-4 bg-blue-100 rounded-full">
                <i class="fas fa-users text-blue-600 text-2xl"></i>
            </div>
        </div>
        <a href="{{ route('admin.users.index') }}" class="text-blue-600 text-sm inline-block hover:underline">
            Alles bekijken <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-gray-500 text-sm font-medium">Offertes</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['quotes'] }}</h3>
                @if($pending['new_quotes'] > 0)
                    <span class="inline-block mt-2 px-2 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">
                        {{ $pending['new_quotes'] }} nieuw
                    </span>
                @endif
            </div>
            <div class="p-4 bg-yellow-100 rounded-full">
                <i class="fas fa-file-invoice text-yellow-600 text-2xl"></i>
            </div>
        </div>
        <a href="{{ route('admin.quotes.index') }}" class="text-yellow-600 text-sm inline-block hover:underline">
            Alles bekijken <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-gray-500 text-sm font-medium">Contact Berichten</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['contact_messages'] }}</h3>
                @if($pending['new_contacts'] > 0)
                    <span class="inline-block mt-2 px-2 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">
                        {{ $pending['new_contacts'] }} nieuw
                    </span>
                @endif
            </div>
            <div class="p-4 bg-green-100 rounded-full">
                <i class="fas fa-envelope text-green-600 text-2xl"></i>
            </div>
        </div>
        <a href="{{ route('admin.contact-messages.index') }}" class="text-green-600 text-sm inline-block hover:underline">
            Alles bekijken <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-gray-500 text-sm font-medium">Portfolio Items</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['portfolio'] }}</h3>
            </div>
            <div class="p-4 bg-purple-100 rounded-full">
                <i class="fas fa-images text-purple-600 text-2xl"></i>
            </div>
        </div>
        <a href="{{ route('admin.portfolios.index') }}" class="text-purple-600 text-sm inline-block hover:underline">
            Alles bekijken <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-gray-500 text-sm font-medium">Nieuws Artikelen</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['news'] }}</h3>
                @if($pending['draft_news'] > 0)
                    <span class="inline-block mt-2 px-2 py-1 bg-gray-100 text-gray-800 text-xs font-semibold rounded-full">
                        {{ $pending['draft_news'] }} concept
                    </span>
                @endif
            </div>
            <div class="p-4 bg-pink-100 rounded-full">
                <i class="fas fa-newspaper text-pink-600 text-2xl"></i>
            </div>
        </div>
        <a href="{{ route('admin.news.index') }}" class="text-pink-600 text-sm inline-block hover:underline">
            Alles bekijken <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-gray-500 text-sm font-medium">Diensten</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['services'] }}</h3>
            </div>
            <div class="p-4 bg-indigo-100 rounded-full">
                <i class="fas fa-concierge-bell text-indigo-600 text-2xl"></i>
            </div>
        </div>
        <a href="{{ route('admin.services.index') }}" class="text-indigo-600 text-sm inline-block hover:underline">
            Alles bekijken <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-gray-500 text-sm font-medium">FAQ Items</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['faqs'] }}</h3>
            </div>
            <div class="p-4 bg-teal-100 rounded-full">
                <i class="fas fa-question-circle text-teal-600 text-2xl"></i>
            </div>
        </div>
        <a href="{{ route('admin.faqs.index') }}" class="text-teal-600 text-sm inline-block hover:underline">
            Alles bekijken <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-800">
                <i class="fas fa-file-invoice text-yellow-600 mr-2"></i>
                Recente Offertes
            </h3>
            <a href="{{ route('admin.quotes.index') }}" class="text-sm text-blue-600 hover:underline">
                Alles bekijken
            </a>
        </div>
        <div class="p-6">
            @forelse($recent['quotes'] as $quote)
                <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">{{ $quote->name }}</p>
                        <p class="text-sm text-gray-500">{{ $quote->service->name ?? 'Geen dienst' }}</p>
                    </div>
                    <div class="text-right">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $quote->status_color }}">
                            {{ $quote->status_label }}
                        </span>
                        <p class="text-xs text-gray-500 mt-1">{{ $quote->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-8">Geen recente offertes</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-800">
                <i class="fas fa-envelope text-green-600 mr-2"></i>
                Recente Contact Berichten
            </h3>
            <a href="{{ route('admin.contact-messages.index') }}" class="text-sm text-blue-600 hover:underline">
                Alles bekijken
            </a>
        </div>
        <div class="p-6">
            @forelse($recent['contacts'] as $contact)
                <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                    <div class="flex items-center flex-1">
                        @if($contact->isNew())
                            <i class="fas fa-circle text-blue-600 text-xs mr-2"></i>
                        @endif
                        <div>
                            <p class="font-medium text-gray-900">{{ $contact->name }}</p>
                            <p class="text-sm text-gray-500">{{ Str::limit($contact->subject, 40) }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $contact->status_color }}">
                            {{ $contact->status_label }}
                        </span>
                        <p class="text-xs text-gray-500 mt-1">{{ $contact->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-8">Geen recente berichten</p>
            @endforelse
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow mb-6">
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
        <h3 class="text-lg font-semibold text-gray-800">
            <i class="fas fa-newspaper text-pink-600 mr-2"></i>
            Recent Nieuws
        </h3>
        <a href="{{ route('admin.news.index') }}" class="text-sm text-blue-600 hover:underline">
            Alles bekijken
        </a>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @forelse($recent['news'] as $news)
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                    <h4 class="font-semibold text-gray-900 mb-2">{{ Str::limit($news->title, 50) }}</h4>
                    <p class="text-sm text-gray-600 mb-3">{{ Str::limit($news->content, 80) }}</p>
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span>{{ $news->author->name }}</span>
                        <span>{{ $news->created_at->diffForHumans() }}</span>
                    </div>
                    @if(!$news->is_published)
                        <span class="inline-block mt-2 px-2 py-1 bg-gray-100 text-gray-800 text-xs font-semibold rounded">
                            Concept
                        </span>
                    @endif
                </div>
            @empty
                <div class="col-span-3">
                    <p class="text-gray-500 text-center py-8">Geen recent nieuws</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">
            <i class="fas fa-bolt text-yellow-600 mr-2"></i>
            Snelle Acties
        </h3>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.news.create') }}" class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition">
                <i class="fas fa-plus-circle text-3xl text-blue-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Nieuw Nieuws</span>
            </a>

            <a href="{{ route('admin.portfolios.create') }}" class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition">
                <i class="fas fa-image text-3xl text-purple-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Nieuw Portfolio</span>
            </a>

            <a href="{{ route('admin.services.create') }}" class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-lg hover:border-indigo-500 hover:bg-indigo-50 transition">
                <i class="fas fa-concierge-bell text-3xl text-indigo-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Nieuwe Dienst</span>
            </a>

            <a href="{{ route('admin.users.create') }}" class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition">
                <i class="fas fa-user-plus text-3xl text-green-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Nieuwe User</span>
            </a>
        </div>
    </div>
</div>

@endsection
