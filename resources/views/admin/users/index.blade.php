@extends('admin.layout')

@section('title', 'Gebruikers')
@section('page-title', 'Gebruikers Beheer')

@section('content')

<div class="mb-6 flex justify-between items-center">
    <div>
        <p class="text-gray-600">Beheer alle gebruikers van het systeem</p>
    </div>
    <a href="{{ route('admin.users.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
        <i class="fas fa-plus mr-2"></i>
        Nieuwe Gebruiker
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Gebruiker
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Email
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Role
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Aangemaakt
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Acties
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                @if($user->profile_photo)
                                    <img class="h-10 w-10 rounded-full object-cover"
                                         src="{{ asset('storage/' . $user->profile_photo) }}"
                                         alt="{{ $user->name }}">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                        <span class="text-gray-600 font-semibold">
                                            {{ substr($user->name, 0, 1) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $user->name }}
                                </div>
                                @if($user->username)
                                    <div class="text-sm text-gray-500">
                                        @{{ $user->username }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $user->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($user->role === 'admin')
                            <span class="px-2 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                <i class="fas fa-crown mr-1"></i> Admin
                            </span>
                        @else
                            <span class="px-2 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-user mr-1"></i> User
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $user->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <form action="{{ route('admin.users.toggle-admin', $user) }}"
                              method="POST"
                              class="inline-block"
                              onsubmit="return confirm('Weet je zeker dat je de rol wilt wijzigen?');">
                            @csrf
                            @if($user->id !== auth()->id())
                                <button type="submit"
                                        class="text-purple-600 hover:text-purple-900 mr-3"
                                        title="{{ $user->role === 'admin' ? 'Verwijder admin' : 'Maak admin' }}">
                                    <i class="fas {{ $user->role === 'admin' ? 'fa-user-shield' : 'fa-user-plus' }}"></i>
                                </button>
                            @endif
                        </form>

                        <a href="{{ route('admin.users.edit', $user) }}"
                           class="text-blue-600 hover:text-blue-900 mr-3">
                            <i class="fas fa-edit"></i>
                        </a>

                        @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Geen gebruikers gevonden.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $users->links() }}
</div>

@endsection
