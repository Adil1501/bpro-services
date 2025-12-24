@extends('admin.layout')

@section('title', 'Diensten')
@section('page-title', 'Diensten Beheer')

@section('content')

<div class="mb-6 flex justify-between items-center">
    <div>
        <p class="text-gray-600">Beheer alle diensten van B-Pro Services</p>
    </div>
    <a href="{{ route('admin.services.create') }}"
       class="px-4 py-2 rounded-lg text-white"
       style="background-color: #2563eb;">
        <i class="fas fa-plus mr-2"></i>
        Nieuwe Dienst
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($services as $service)
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
            <div class="p-6 {{ $service->is_active ? 'bg-gradient-to-r from-blue-500 to-blue-600' : 'bg-gray-400' }}">
                <div class="flex items-center justify-between text-white">
                    <div class="flex items-center">
                        @if($service->icon)
                            <i class="fas {{ $service->icon }} text-3xl mr-4"></i>
                        @else
                            <i class="fas fa-concierge-bell text-3xl mr-4"></i>
                        @endif
                        <div>
                            <h3 class="text-xl font-bold">{{ $service->name }}</h3>
                            <p class="text-sm opacity-90">{{ $service->slug }}</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-white bg-opacity-20 rounded-full text-sm font-semibold">
                        #{{ $service->order }}
                    </span>
                </div>
            </div>

            <div class="p-6">
                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                    {{ $service->description }}
                </p>

                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-file-invoice mr-2 text-blue-600"></i>
                        <span>{{ $service->quotes_count }} {{ Str::plural('offerte', $service->quotes_count) }}</span>
                    </div>

                    @if($service->is_active)
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                            <i class="fas fa-check-circle mr-1"></i> Actief
                        </span>
                    @else
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-semibold">
                            <i class="fas fa-pause-circle mr-1"></i> Inactief
                        </span>
                    @endif
                </div>

                <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                    <a href="{{ route('admin.services.edit', $service) }}"
                       class="text-blue-600 hover:text-blue-900">
                        <i class="fas fa-edit mr-1"></i> Bewerken
                    </a>

                    <form action="{{ route('admin.services.destroy', $service) }}"
                          method="POST"
                          class="inline-block"
                          onsubmit="return confirm('Weet je zeker dat je deze dienst wilt verwijderen?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-red-600 hover:text-red-900"
                                {{ $service->quotes_count > 0 ? 'disabled title=In gebruik bij offertes' : '' }}>
                            <i class="fas fa-trash mr-1"></i> Verwijderen
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white rounded-lg shadow p-12 text-center">
            <i class="fas fa-concierge-bell text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Geen diensten gevonden</h3>
            <p class="text-gray-500 mb-6">Begin met het toevoegen van je eerste dienst</p>
            <a href="{{ route('admin.services.create') }}"
               class="inline-block px-6 py-3 rounded-lg text-white"
               style="background-color: #2563eb;">
                <i class="fas fa-plus mr-2"></i>
                Maak je eerste dienst
            </a>
        </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $services->links() }}
</div>

@endsection
