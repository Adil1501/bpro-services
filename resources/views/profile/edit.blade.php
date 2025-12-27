@extends('frontend.layouts.app')

@section('title', 'Profiel Bewerken')

@section('content')

<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl shadow-lg p-6 text-white">
            <h1 class="text-3xl font-bold">Mijn Profiel Bewerken</h1>
            <p class="text-blue-100 mt-2">Beheer je persoonlijke gegevens en zichtbaarheid</p>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            Profiel Informatie
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Update je profiel informatie en profielfoto
                        </p>
                    </header>

                    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Profielfoto</label>

                            <div class="flex items-center gap-6">
                                <div class="shrink-0">
                                    <img class="h-24 w-24 object-cover rounded-full border-4 border-blue-100"
                                         src="{{ auth()->user()->profile_photo_url }}"
                                         alt="Huidige profielfoto">
                                </div>

                                <div class="flex-1">
                                    <input type="file"
                                           name="profile_photo"
                                           accept="image/*"
                                           class="block w-full text-sm text-gray-500
                                                  file:mr-4 file:py-2 file:px-4
                                                  file:rounded-lg file:border-0
                                                  file:text-sm file:font-semibold
                                                  file:bg-blue-50 file:text-blue-700
                                                  hover:file:bg-blue-100">
                                    <p class="mt-2 text-sm text-gray-500">JPG, PNG of GIF (max. 2MB)</p>
                                </div>
                            </div>
                            @error('profile_photo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Naam</label>
                            <input id="name"
                                   name="name"
                                   type="text"
                                   value="{{ old('name', $user->name) }}"
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                   required>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700">Gebruikersnaam</label>
                            <div class="mt-1 flex rounded-lg shadow-sm">
                                <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    @
                                </span>
                                <input id="username"
                                       name="username"
                                       type="text"
                                       value="{{ old('username', $user->username) }}"
                                       class="flex-1 block w-full px-4 py-2 border border-gray-300 rounded-r-lg focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="janjansen">
                            </div>
                            <p class="mt-2 text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Je publieke profiel is beschikbaar op: /profile/@{{ $user->username ?? 'username' }}
                            </p>
                            @error('username')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input id="email"
                                   name="email"
                                   type="email"
                                   value="{{ old('email', $user->email) }}"
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                   required>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="birthday" class="block text-sm font-medium text-gray-700">Geboortedatum</label>
                            <input id="birthday"
                                   name="birthday"
                                   type="date"
                                   value="{{ old('birthday', $user->birthday?->format('Y-m-d')) }}"
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            @error('birthday')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="bio" class="block text-sm font-medium text-gray-700">Over Mij</label>
                            <textarea id="bio"
                                      name="bio"
                                      rows="4"
                                      class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Vertel iets over jezelf...">{{ old('bio', $user->bio) }}</textarea>
                            <p class="mt-2 text-sm text-gray-500">Maximaal 500 karakters</p>
                            @error('bio')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit"
                                    class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                                <i class="fas fa-save mr-2"></i>
                                Profiel Opslaan
                            </button>

                            @if (session('status') === 'profile-updated')
                                <p class="text-sm text-green-600 flex items-center">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    Opgeslagen!
                                </p>
                            @endif
                        </div>
                    </form>
                </section>
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>

@endsection
