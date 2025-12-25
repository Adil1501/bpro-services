@extends('admin.layout')

@section('title', 'Portfolio Bewerken')
@section('page-title', 'Portfolio Bewerken: ' . $portfolio->title)

@section('content')

<form action="{{ route('admin.portfolios.update', $portfolio) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                    Basis Informatie
                </h3>

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Project Titel <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="title"
                           id="title"
                           value="{{ old('title', $portfolio->title) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                           required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Beschrijving <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description"
                              id="description"
                              rows="6"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                              required>{{ old('description', $portfolio->description) }}</textarea>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-images text-blue-600 mr-2"></i>
                    Voor & Na Foto's
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Voor Foto
                        </label>

                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $portfolio->before_image) }}"
                                 alt="Huidige voor foto"
                                 class="w-full h-48 object-cover rounded-lg border-2 border-gray-300">
                            <p class="text-xs text-gray-500 mt-1">Huidige foto</p>
                        </div>

                        <input type="file"
                               name="before_image"
                               id="before_image"
                               accept="image/*"
                               class="hidden"
                               onchange="previewImage(this, 'beforePreview')">

                        <label for="before_image"
                               class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50 transition">
                            <div id="beforePreview" class="hidden w-full h-full">
                                <img src="" alt="Preview" class="w-full h-full object-cover rounded-lg">
                            </div>
                            <div id="beforePlaceholder" class="flex flex-col items-center justify-center py-3">
                                <i class="fas fa-upload text-2xl text-gray-400 mb-2"></i>
                                <p class="text-xs text-gray-600">Klik om nieuwe foto te uploaden</p>
                            </div>
                        </label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Na Foto
                        </label>

                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $portfolio->after_image) }}"
                                 alt="Huidige na foto"
                                 class="w-full h-48 object-cover rounded-lg border-2 border-gray-300">
                            <p class="text-xs text-gray-500 mt-1">Huidige foto</p>
                        </div>

                        <input type="file"
                               name="after_image"
                               id="after_image"
                               accept="image/*"
                               class="hidden"
                               onchange="previewImage(this, 'afterPreview')">

                        <label for="after_image"
                               class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50 transition">
                            <div id="afterPreview" class="hidden w-full h-full">
                                <img src="" alt="Preview" class="w-full h-full object-cover rounded-lg">
                            </div>
                            <div id="afterPlaceholder" class="flex flex-col items-center justify-center py-3">
                                <i class="fas fa-upload text-2xl text-gray-400 mb-2"></i>
                                <p class="text-xs text-gray-600">Klik om nieuwe foto te uploaden</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-map-marker-alt text-blue-600 mr-2"></i>
                    Locatie & Details
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                            Locatie
                        </label>
                        <input type="text"
                               name="location"
                               id="location"
                               value="{{ old('location', $portfolio->location) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                               placeholder="Bijv: Leuven, België">
                    </div>

                    <div>
                        <label for="completed_at" class="block text-sm font-medium text-gray-700 mb-2">
                            Afgerond op
                        </label>
                        <input type="date"
                               name="completed_at"
                               id="completed_at"
                               value="{{ old('completed_at', $portfolio->completed_at?->format('Y-m-d')) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-chart-bar text-blue-600 mr-2"></i>
                    Statistieken
                </h3>

                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                        <span class="text-sm text-gray-700">Likes</span>
                        <span class="font-bold text-red-600">
                            <i class="fas fa-heart mr-1"></i>
                            {{ $portfolio->likes_count }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-folder text-blue-600 mr-2"></i>
                    Categorie
                </h3>

                <select name="category_id"
                        id="category_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                                {{ old('category_id', $portfolio->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-star text-blue-600 mr-2"></i>
                    Featured
                </h3>

                <input type="hidden" name="is_featured" value="0">
                <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer">
                    <input type="checkbox"
                           name="is_featured"
                           value="1"
                           {{ old('is_featured', $portfolio->is_featured) == 1 ? 'checked' : '' }}
                           class="rounded border-gray-300 text-yellow-600">
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700">Featured Project</p>
                        <p class="text-xs text-gray-500">Uitgelicht op homepage</p>
                    </div>
                </label>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <button type="submit"
                        class="w-full px-4 py-3 rounded-lg text-white font-semibold mb-3"
                        style="background-color: #2563eb;">
                    <i class="fas fa-save mr-2"></i>
                    Wijzigingen Opslaan
                </button>

                <a href="{{ route('admin.portfolios.index') }}"
                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 text-center hover:bg-gray-50">
                    Annuleren
                </a>
            </div>
        </div>
    </div>
</form>

<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const placeholder = document.getElementById(previewId.replace('Preview', 'Placeholder'));

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.querySelector('img').src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
