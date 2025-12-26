@extends('admin.layout')

@section('title', 'Contact Berichten')
@section('page-title', 'Contact Berichten')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-envelope text-2xl"></i>
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
                <i class="fas fa-bell text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Nieuw</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['new'] }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-check-circle text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Gelezen</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['read'] }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-gray-100 text-gray-600">
                <i class="fas fa-archive text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Gearchiveerd</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['archived'] }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6 mb-6">
    <form method="GET" action="{{ route('admin.contact-messages.index') }}" class="flex flex-wrap gap-4">
        <div class="flex-1 min-w-[200px]">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Zoek naam, email, onderwerp..."
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>

        <div class="min-w-[150px]">
            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">Alle statussen</option>
                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>Nieuw</option>
                <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Gelezen</option>
                <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Gearchiveerd</option>
            </select>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                <i class="fas fa-search mr-2"></i>Filter
            </button>
            <a href="{{ route('admin.contact-messages.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
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
                    Status
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Van
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Onderwerp
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
            @forelse($messages as $message)
                <tr class="hover:bg-gray-50 {{ $message->isNew() ? 'bg-blue-50' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $message->status_color }}">
                            {{ $message->status_label }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($message->isNew())
                                <i class="fas fa-circle text-blue-600 text-xs mr-2"></i>
                            @endif
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $message->name }}</div>
                                <div class="text-sm text-gray-500">{{ $message->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900 font-medium">{{ $message->subject }}</div>
                        <div class="text-sm text-gray-500 truncate max-w-md">{{ Str::limit($message->message, 60) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $message->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.contact-messages.show', $message) }}"
                           class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-eye mr-1"></i>Bekijken
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-3"></i>
                        <p>Geen contact berichten gevonden</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $messages->links() }}
</div>

@endsection
