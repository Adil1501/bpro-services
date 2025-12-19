@extends('admin.layout')

@section('title', 'Tags')
@section('page-title', 'Tags Beheer')

@section('content')

<div class="mb-6 flex justify-between items-center">
    <div>
        <p class="text-gray-600">Beheer alle nieuwstags</p>
    </div>
    <a href="{{ route('admin.tags.create') }}"
       class="px-4 py-2 rounded-lg text-white"
       style="background-color: #2563eb;">
        <i class="fas fa-plus mr-2"></i>
        Nieuwe Tag
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
    @forelse($tags as $tag)
        <div class="bg-white rounded-lg shadow p-4 hover:shadow-md transition">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-tag text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ $tag->name }}</h3>
                        <p class="text-xs text-gray-500">{{ $tag->slug }}</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-600">
                    <i class="fas fa-newspaper mr-1"></i>
                    {{ $tag->news_posts_count }} {{ Str::plural('bericht', $tag->news_posts_count) }}
                </span>

                <div class="flex space-x-2">
                    <a href="{{ route('admin.tags.edit', $tag) }}"
                       class="text-blue-600 hover:text-blue-900">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.tags.destroy', $tag) }}"
                          method="POST"
                          class="inline-block"
                          onsubmit="return confirm('Weet je zeker dat je deze tag wilt verwijderen?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-red-600 hover:text-red-900"
                                {{ $tag->news_posts_count > 0 ? 'disabled title=In gebruik' : '' }}>
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white rounded-lg shadow p-8 text-center">
            <i class="fas fa-tags text-gray-300 text-4xl mb-4"></i>
            <p class="text-gray-500 mb-4">Geen tags gevonden</p>
            <a href="{{ route('admin.tags.create') }}"
               class="inline-block px-4 py-2 rounded-lg text-white"
               style="background-color: #2563eb;">
                <i class="fas fa-plus mr-2"></i>
                Maak je eerste tag
            </a>
        </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $tags->links() }}
</div>

@endsection
