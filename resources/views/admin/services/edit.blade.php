@extends('admin.layout')

@section('title', 'Dienst Bewerken')
@section('page-title', 'Dienst Bewerken: ' . $service->name)

@section('content')

<div class="max-w-3xl">
    <form action="{{ route('admin.services.update', $service) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow p-6">

            @if($service->quotes()->count() > 0)
                <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-600 mt-1 mr-3"></i>
                        <div>
                            <h4 class="text-sm font-semibold text-blue-900 mb-1">Deze dienst is in gebruik</h4>
                            <p class="text-sm text-blue-700">
                                {{ $service->quotes()->count() }} {{ Str::plural('offerte', $service->quotes()->count()) }} gekoppeld aan deze dienst
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Dienst Naam <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name', $service->name) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                       required>
                @error('name')
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
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                          required>{{ old('description', $service->description) }}</textarea>
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
                           value="{{ old('icon', $service->icon) }}"
                           class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('icon') border-red-500 @enderror"
                           placeholder="fa-broom"
                           oninput="updateIconPreview()">

                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i id="iconPreview" class="fas {{ $service->icon ?? 'fa-concierge-bell' }} text-blue-600 text-2xl"></i>
                    </div>
                </div>
                @error('icon')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                        Volgorde
                    </label>
                    <input type="number"
                           name="order"
                           id="order"
                           value="{{ old('order', $service->order) }}"
                           min="0"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('order') border-red-500 @enderror">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Status
                    </label>

                    <input type="hidden" name="is_active" value="0">

                    <label class="inline-flex items-center px-4 py-2 bg-gray-50 rounded-lg cursor-pointer">
                        <input type="checkbox"
                            name="is_active"
                            value="1"
                            {{ old('is_active', $service->is_active) ? 'checked' : '' }}
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
                    Bijwerken
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
