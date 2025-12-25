@extends('admin.layout')

@section('title', 'Portfolio Projecten')
@section('page-title', 'Portfolio Projecten')

@section('content')

<div class="mb-6 flex justify-between items-center">
    <div>
        <p class="text-gray-600">Beheer al je portfolio projecten met voor/na foto's</p>
    </div>
    <a href="{{ route('admin.portfolios.create') }}"
       class="px-4 py-2 rounded-lg text-white"
       style="background-color: #2563eb;">
        <i class="fas fa-plus mr-2"></i>
        Nieuw Project
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-images text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Totaal Projecten</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $portfolios->total() }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-star text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Featured</p>
                <h3 class="text-2xl font-bold text-gray-800">
                    {{ \App\Models\Portfolio::where('is_featured', true)->count() }}
                </h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-100 text-red-600">
                <i class="fas fa-heart text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Totaal Likes</p>
                <h3 class="text-2xl font-bold text-gray-800">
                    {{ \App\Models\Portfolio::sum('likes_count') }}
                </h3>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($portfolios as $portfolio)
        <div class="bg-white rounded-lg shadow hover:shadow-xl transition overflow-hidden group">}
            <div class="relative h-64 overflow-hidden">
                <div class="absolute inset-0">
                    <img src="{{ asset('storage/' . $portfolio->before_image) }}"
                         alt="Voor"
                         class="w-full h-full object-cover">
                    <div class="absolute top-2 left-2 px-3 py-1 bg-red-500 text-white text-xs font-bold rounded">
                        VOOR
                    </div>
                </div>

                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <img src="{{ asset('storage/' . $portfolio->after_image) }}"
                         alt="Na"
                         class="w-full h-full object-cover">
                    <div class="absolute top-2 left-2 px-3 py-1 bg-green-500 text-white text-xs font-bold rounded">
                        NA
                    </div>
                </div>

                @if($portfolio->is_featured)
                    <div class="absolute top-2 right-2">
                        <span class="px-2 py-1 bg-yellow-500 text-white text-xs font-bold rounded">
                            <i class="fas fa-star"></i> FEATURED
                        </span>
                    </div>
                @endif
            </div>

            <div class="p-4">
                <div class="mb-2">
                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold"
                          style="background-color: {{ $portfolio->category->color ?? '#3B82F6' }}; color: white;">
                        @if($portfolio->category->icon)
                            <i class="fas {{ $portfolio->category->icon }} mr-1"></i>
                        @endif
                        {{ $portfolio->category->name }}
                    </span>
                </div>

                <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2">
                    {{ $portfolio->title }}
                </h3>

                <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                    {{ $portfolio->description }}
                </p>

                <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                    @if($portfolio->location)
                        <span><i class="fas fa-map-marker-alt mr-1"></i> {{ $portfolio->location }}</span>
                    @endif

                    @if($portfolio->completed_at)
                        <span><i class="fas fa-calendar mr-1"></i> {{ $portfolio->completed_at->format('M Y') }}</span>
                    @endif
                </div>

                <div class="flex items-center justify-between text-sm border-t border-gray-200 pt-3 mb-3">
                    <div class="flex items-center text-gray-500">
                        <i class="fas fa-heart text-red-500 mr-1"></i>
                        <span>{{ $portfolio->likes_count }} {{ Str::plural('like', $portfolio->likes_count) }}</span>
                    </div>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('admin.portfolios.edit', $portfolio) }}"
                       class="flex-1 px-3 py-2 bg-blue-500 text-white text-center text-sm rounded hover:bg-blue-600 transition">
                        <i class="fas fa-edit mr-1"></i> Bewerken
                    </a>

                    <form action="{{ route('admin.portfolios.toggle-featured', $portfolio) }}"
                          method="POST"
                          class="inline-block">
                        @csrf
                        <button type="submit"
                                class="px-3 py-2 {{ $portfolio->is_featured ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-gray-300 hover:bg-gray-400' }} text-white text-sm rounded transition"
                                title="{{ $portfolio->is_featured ? 'Verwijder featured' : 'Maak featured' }}">
                            <i class="fas fa-star"></i>
                        </button>
                    </form>

                    <form action="{{ route('admin.portfolios.destroy', $portfolio) }}"
                          method="POST"
                          onsubmit="return confirm('Weet je zeker dat je dit project wilt verwijderen?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white text-sm rounded transition">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white rounded-lg shadow p-12 text-center">
            <i class="fas fa-images text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Geen portfolio projecten gevonden</h3>
            <p class="text-gray-500 mb-6">Begin met het toevoegen van je eerste project</p>
            <a href="{{ route('admin.portfolios.create') }}"
               class="inline-block px-6 py-3 rounded-lg text-white"
               style="background-color: #2563eb;">
                <i class="fas fa-plus mr-2"></i>
                Maak je eerste project
            </a>
        </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $portfolios->links() }}
</div>

@endsection
