@extends('admin.layout')

@section('title', 'Nieuwe Categorie')
@section('page-title', 'Nieuwe Categorie Maken')

@section('content')

<div class="max-w-2xl">
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="bg-white rounded-lg shadow p-6">

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Naam <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                       placeholder="Bijv: Schoonmaak, Renovatie, Facturatie"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">De slug wordt automatisch gegenereerd</p>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Beschrijving (optioneel)
                </label>
                <textarea name="description"
                          id="description"
                          rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                          placeholder="Korte beschrijving van deze categorie">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                    Volgorde (optioneel)
                </label>
                <input type="number"
                       name="order"
                       id="order"
                       value="{{ old('order', 0) }}"
                       min="0"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('order') border-red-500 @enderror">
                @error('order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Lager nummer = hogere prioriteit (0 = eerst)</p>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.categories.index') }}"
                   class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Annuleren
                </a>
                <button type="submit"
                        class="px-4 py-2 rounded-lg text-white"
                        style="background-color: #2563eb;">
                    <i class="fas fa-save mr-2"></i>
                    Opslaan
                </button>
            </div>

        </div>
    </form>
</div>

@endsection
