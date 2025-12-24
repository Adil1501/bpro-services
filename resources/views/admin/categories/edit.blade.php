@extends('admin.layout')

@section('title', 'Categorie Bewerken')
@section('page-title', 'Categorie Bewerken: ' . $category->name)

@section('content')

<div class="max-w-2xl">
    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow p-6">

            <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                <h3 class="text-sm font-semibold text-blue-900 mb-2">
                    <i class="fas fa-info-circle mr-1"></i>
                    Deze categorie is in gebruik bij:
                </h3>
                <div class="grid grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="font-medium">{{ $category->faqs_count }}</span>
                        <span class="text-blue-700">FAQs</span>
                    </div>
                    <div>
                        <span class="font-medium">{{ $category->portfolio_projects_count }}</span>
                        <span class="text-blue-700">Portfolio</span>
                    </div>
                    <div>
                        <span class="font-medium">{{ $category->tickets_count }}</span>
                        <span class="text-blue-700">Tickets</span>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Naam <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name', $category->name) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Beschrijving (optioneel)
                </label>
                <textarea name="description"
                          id="description"
                          rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                    Volgorde
                </label>
                <input type="number"
                       name="order"
                       id="order"
                       value="{{ old('order', $category->order) }}"
                       min="0"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('order') border-red-500 @enderror">
                @error('order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
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
                    Bijwerken
                </button>
            </div>

        </div>
    </form>
</div>

@endsection
