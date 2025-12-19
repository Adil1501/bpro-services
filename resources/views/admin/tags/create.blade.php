@extends('admin.layout')

@section('title', 'Nieuwe Tag')
@section('page-title', 'Nieuwe Tag Maken')

@section('content')

<div class="max-w-2xl">
    <form action="{{ route('admin.tags.store') }}" method="POST">
        @csrf

        <div class="bg-white rounded-lg shadow p-6">

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Tag Naam <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                       placeholder="Bijv: Tips, Nieuws, Promotie"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">De slug wordt automatisch gegenereerd</p>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.tags.index') }}"
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
