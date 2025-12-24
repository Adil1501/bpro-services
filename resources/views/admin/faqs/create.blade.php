@extends('admin.layout')

@section('title', 'Nieuwe FAQ')
@section('page-title', 'Nieuwe FAQ Maken')

@section('content')

<div class="max-w-4xl">
    <form action="{{ route('admin.faqs.store') }}" method="POST">
        @csrf

        <div class="bg-white rounded-lg shadow p-6">

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Categorie <span class="text-red-500">*</span>
                </label>
                <select name="category_id"
                        id="category_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('category_id') border-red-500 @enderror"
                        required>
                    <option value="">Selecteer een categorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @if($categories->isEmpty())
                    <p class="mt-2 text-sm text-amber-600">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        Geen categorieën beschikbaar. <a href="{{ route('admin.categories.create') }}" class="text-blue-600 underline">Maak er eerst een aan</a>.
                    </p>
                @endif
            </div>

            <div class="mb-4">
                <label for="question" class="block text-sm font-medium text-gray-700 mb-2">
                    Vraag <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="question"
                       id="question"
                       value="{{ old('question') }}"
                       maxlength="500"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('question') border-red-500 @enderror"
                       placeholder="Hoe vaak moet ik mijn kantoor laten schoonmaken?"
                       required>
                @error('question')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Max 500 karakters</p>
            </div>

            <div class="mb-4">
                <label for="answer" class="block text-sm font-medium text-gray-700 mb-2">
                    Antwoord <span class="text-red-500">*</span>
                </label>
                <textarea name="answer"
                          id="answer"
                          rows="8"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('answer') border-red-500 @enderror"
                          placeholder="Geef een uitgebreid antwoord op de vraag..."
                          required>{{ old('answer') }}</textarea>
                @error('answer')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                        Volgorde (optioneel)
                    </label>
                    <input type="number"
                           name="order"
                           id="order"
                           value="{{ old('order', 0) }}"
                           min="0"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('order') border-red-500 @enderror">
                    <p class="mt-1 text-sm text-gray-500">Lager = eerder getoond</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Status
                    </label>
                    <label class="inline-flex items-center px-4 py-2 bg-gray-50 rounded-lg cursor-pointer">
                        <input type="checkbox"
                               name="is_published"
                               value="1"
                               {{ old('is_published', true) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600">
                        <span class="ml-2 text-sm text-gray-700">Publiceren (direct zichtbaar)</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.faqs.index') }}"
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
