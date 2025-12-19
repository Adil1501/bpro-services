@extends('admin.layout')

@section('title', 'Nieuwsbericht Bewerken')
@section('page-title', 'Nieuwsbericht Bewerken')

@section('content')

<div class="max-w-4xl">
    <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow p-6">

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Titel <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="title"
                       id="title"
                       value="{{ old('title', $news->title) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                       required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                    Samenvatting (optioneel)
                </label>
                <input type="text"
                       name="excerpt"
                       id="excerpt"
                       value="{{ old('excerpt', $news->excerpt) }}"
                       maxlength="500"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('excerpt') border-red-500 @enderror"
                       placeholder="Korte samenvatting voor overzichtspagina">
                @error('excerpt')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    Content <span class="text-red-500">*</span>
                </label>
                <textarea name="content"
                          id="content"
                          rows="12"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('content') border-red-500 @enderror"
                          required>{{ old('content', $news->content) }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            @if($news->image)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Huidige Afbeelding
                    </label>
                    <div class="flex items-start">
                        <img src="{{ asset('storage/' . $news->image) }}"
                             alt="{{ $news->title }}"
                             class="h-32 object-cover rounded-lg">
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Upload een nieuwe afbeelding om deze te vervangen</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $news->image ? 'Nieuwe' : 'Featured' }} Image (optioneel)
                </label>
                <input type="file"
                       name="image"
                       id="image"
                       accept="image/*"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('image') border-red-500 @enderror"
                       onchange="previewImage(event)">
                <p class="mt-1 text-sm text-gray-500">JPG, PNG of GIF. Max 2MB.</p>
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <div id="imagePreview" class="mt-4 hidden">
                    <img id="preview" class="h-48 object-cover rounded-lg" alt="Preview">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Tags
                </label>
                <div class="flex flex-wrap gap-2">
                    @foreach($tags as $tag)
                        <label class="inline-flex items-center px-3 py-2 bg-gray-100 rounded-lg cursor-pointer hover:bg-gray-200">
                            <input type="checkbox"
                                   name="tags[]"
                                   value="{{ $tag->id }}"
                                   {{ in_array($tag->id, old('tags', $news->tags->pluck('id')->toArray())) ? 'checked' : '' }}
                                   class="mr-2">
                            <span class="text-sm">{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>
                @if($tags->isEmpty())
                    <p class="text-sm text-gray-500 mt-2">
                        Geen tags beschikbaar. <a href="{{ route('admin.tags.create') }}" class="text-blue-600">Maak er een aan</a>.
                    </p>
                @endif
            </div>

            <div class="mb-4">
                <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">
                    Publicatiedatum
                </label>
                <input type="datetime-local"
                       name="published_at"
                       id="published_at"
                       value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label class="inline-flex items-center">
                    <input type="checkbox"
                           name="is_published"
                           value="1"
                           {{ old('is_published', $news->is_published) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-700">Gepubliceerd (zichtbaar voor bezoekers)</span>
                </label>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.news.index') }}"
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

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');

    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>

@endsection
