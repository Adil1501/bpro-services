@extends('admin.layout')

@section('title', 'Nieuwe Dienst')
@section('page-title', 'Nieuwe Dienst Toevoegen')

@section('content')

<div class="max-w-3xl">
    <form action="{{ route('admin.services.store') }}" method="POST">
        @csrf

        <div class="bg-white rounded-lg shadow p-6">

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Dienst Naam <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                       placeholder="Bijv: Kantoor Schoonmaak"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">De slug wordt automatisch gegenereerd</p>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Beschrijving <span class="text-red-500">*</span>
                </label>
                <textarea name="description"
                          id="description"
                          rows="6"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                          placeholder="Beschrijf de dienst in detail..."
                          required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                    Font Awesome Icon (optioneel)
                </label>
                <div class="flex items-center gap-4">
                    <input type="text"
                           name="icon"
                           id="icon"
                           value="{{ old('icon') }}"
                           class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('icon') border-red-500 @enderror"
                           placeholder="fa-broom"
                           oninput="updateIconPreview()">

                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i id="iconPreview" class="fas fa-concierge-bell text-blue-600 text-2xl"></i>
                    </div>
                </div>
                @error('icon')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">
                    Zoek iconen op <a href="https://fontawesome.com/icons" target="_blank" class="text-blue-600 underline">FontAwesome</a>.
                    Gebruik alleen de class naam (bijv: fa-broom, fa-window, fa-hammer)
                </p>
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
                               name="is_active"
                               value="1"
                               {{ old('is_active', true) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600">
                        <span class="ml-2 text-sm text-gray-700">Actief (zichtbaar voor klanten)</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.services.index') }}"
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

<script>
function updateIconPreview() {
    const input = document.getElementById('icon');
    const preview = document.getElementById('iconPreview');
    const iconClass = input.value.trim();

    preview.className = 'fas text-blue-600 text-2xl';

    if (iconClass) {
        const iconName = iconClass.startsWith('fa-') ? iconClass : 'fa-' + iconClass;
        preview.className = 'fas ' + iconName + ' text-blue-600 text-2xl';
    } else {
        preview.className = 'fas fa-concierge-bell text-blue-600 text-2xl';
    }
}
</script>

@endsection
