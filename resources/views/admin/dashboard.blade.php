@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Gebruikers</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_users'] }}</p>
            </div>
            <div class="bg-blue-100 rounded-full p-3">
                <i class="fas fa-users text-blue-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Nieuwsberichten</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_news'] }}</p>
            </div>
            <div class="bg-green-100 rounded-full p-3">
                <i class="fas fa-newspaper text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Openstaande Offertes</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['pending_quotes'] }}</p>
            </div>
            <div class="bg-yellow-100 rounded-full p-3">
                <i class="fas fa-file-invoice text-yellow-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Open Tickets</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['open_tickets'] }}</p>
            </div>
            <div class="bg-red-100 rounded-full p-3">
                <i class="fas fa-ticket-alt text-red-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Ongelezen Berichten</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['unread_messages'] }}</p>
            </div>
            <div class="bg-purple-100 rounded-full p-3">
                <i class="fas fa-envelope text-purple-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Portfolio Projecten</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_projects'] }}</p>
            </div>
            <div class="bg-indigo-100 rounded-full p-3">
                <i class="fas fa-images text-indigo-600 text-2xl"></i>
            </div>
        </div>
    </div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Recente Offertes</h3>
        </div>
        <div class="p-6">
            @forelse($recent_quotes as $quote)
                <div class="mb-4 pb-4 border-b border-gray-200 last:border-0">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-medium text-gray-800">{{ $quote->name }}</p>
                            <p class="text-sm text-gray-600">{{ $quote->service->name }}</p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $quote->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full
                            @if($quote->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($quote->status === 'approved') bg-green-100 text-green-800
                            @elseif($quote->status === 'rejected') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst($quote->status) }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-4">Geen recente offertes</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Recente Tickets</h3>
        </div>
        <div class="p-6">
            @forelse($recent_tickets as $ticket)
                <div class="mb-4 pb-4 border-b border-gray-200 last:border-0">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-medium text-gray-800">{{ $ticket->subject }}</p>
                            <p class="text-sm text-gray-600">
                                {{ $ticket->user->name }} • {{ $ticket->category->name }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $ticket->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full
                            @if($ticket->priority === 'urgent') bg-red-100 text-red-800
                            @elseif($ticket->priority === 'high') bg-orange-100 text-orange-800
                            @elseif($ticket->priority === 'medium') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst($ticket->priority) }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-4">Geen recente tickets</p>
            @endforelse
        </div>
    </div>

</div>

@endsection
