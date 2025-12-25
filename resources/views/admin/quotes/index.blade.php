@extends('admin.layout')

@section('title', 'Offerte Aanvragen')
@section('page-title', 'Offerte Aanvragen Beheer')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-file-invoice text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Totaal</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-exclamation-circle text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Nieuw</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['new'] }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <i class="fas fa-clock text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">In Behandeling</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['in_progress'] }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-check-circle text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Goedgekeurd</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['quoted'] }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-paper-plane text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Offerte Verzonden</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['quoted'] }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6 mb-6">
    <form method="GET" action="{{ route('admin.quotes.index') }}" class="flex flex-wrap gap-4">
        <div class="flex-1 min-w-[200px]">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Zoek klant, email, telefoon..."
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>

        <div class="min-w-[150px]">
            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">Alle statussen</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Nieuw</option>
                <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>In Behandeling</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Goedgekeurd</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Afgewezen</option>
            </select>
        </div>

        <div class="min-w-[150px]">
            <select name="urgency" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">Alle urgentie</option>
                <option value="low" {{ request('urgency') == 'low' ? 'selected' : '' }}>Laag</option>
                <option value="normal" {{ request('urgency') == 'normal' ? 'selected' : '' }}>Normaal</option>
                <option value="high" {{ request('urgency') == 'high' ? 'selected' : '' }}>Hoog</option>
            </select>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                <i class="fas fa-search mr-2"></i>Filter
            </button>
            <a href="{{ route('admin.quotes.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                Reset
            </a>
        </div>
    </form>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    #ID
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Klant
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Dienst
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Locatie
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Urgentie
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Datum
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Acties
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($quotes as $quote)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-medium text-gray-900">#{{ $quote->id }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $quote->customer_name }}</div>
                        <div class="text-sm text-gray-500">{{ $quote->customer_email }}</div>
                        <div class="text-sm text-gray-500">{{ $quote->customer_phone }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-gray-900">
                            {{ $quote->service->name ?? 'Geen dienst' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $quote->city }}</div>
                        <div class="text-sm text-gray-500">{{ $quote->postal_code }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $quote->status_color }}">
                            {{ $quote->status_label }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $quote->urgency_color }}">
                            {{ ucfirst($quote->urgency) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $quote->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.quotes.show', $quote) }}"
                           class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-eye mr-1"></i>Bekijken
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-3"></i>
                        <p>Geen offerte aanvragen gevonden</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $quotes->links() }}
</div>

@endsection
