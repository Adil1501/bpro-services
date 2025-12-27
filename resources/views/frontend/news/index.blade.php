@extends('frontend.layouts.app')

@section('title', 'Nieuws & Updates - B-Pro Services')
@section('description', 'Blijf op de hoogte van het laatste nieuws en updates van B-Pro Services')

@section('content')

<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Nieuws & Updates
            </h1>
            <p class="text-xl text-blue-100">
                Blijf op de hoogte van onze laatste projecten, tips en updates
            </p>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">

        @if($news->isEmpty())
            <div class="max-w-2xl mx-auto text-center py-12">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-newspaper text-gray-400 text-5xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Nog geen nieuwsartikelen</h2>
                <p class="text-gray-600 mb-6">We zijn bezig met het toevoegen van nieuws. Kom later terug!</p>
                <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Terug naar Home
                </a>
            </div>
        @else
            @php
                $featured = $news->where('is_featured', true)->first();
            @endphp

            @if($featured)
                <div class="max-w-6xl mx-auto mb-12">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="grid grid-cols-1 lg:grid-cols-2">
                            <div class="relative h-96 lg:h-auto bg-gray-200">
                                @if($featured->image)
                                    <img src="{{ Storage::url($featured->image) }}"
                                         alt="{{ $featured->title }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-newspaper text-gray-300 text-6xl"></i>
                                    </div>
                                @endif
                                <div class="absolute top-4 left-4 bg-red-600 text-white px-4 py-2 rounded-lg font-bold shadow-lg">
                                    <i class="fas fa-star mr-2"></i>Featured
                                </div>
                            </div>

                            <div class="p-8 lg:p-12 flex flex-col justify-center">
                                <div class="mb-4">
                                    <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ $featured->published_at->format('d M Y') }}
                                    </span>
                                </div>

                                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                                    {{ $featured->title }}
                                </h2>

                                <p class="text-gray-600 mb-6 text-lg leading-relaxed">
                                    {{ Str::limit($featured->excerpt ?? $featured->content, 200) }}
                                </p>

                                @if($featured->tags->isNotEmpty())
                                    <div class="flex flex-wrap gap-2 mb-6">
                                        @foreach($featured->tags->take(3) as $tag)
                                            <span class="inline-block bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-medium">
                                                #{{ $tag->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                <a href="{{ route('news.show', $featured) }}"
                                   class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                                    Lees Meer <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($news->where('is_featured', false) as $article)
                    <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition group">
                        <div class="relative h-48 bg-gray-200 overflow-hidden">
                            @if($article->image)
                                <img src="{{ Storage::url($article->image) }}"
                                     alt="{{ $article->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-newspaper text-gray-300 text-4xl"></i>
                                </div>
                            @endif

                            <div class="absolute bottom-4 left-4 bg-white px-3 py-1 rounded-lg shadow-md">
                                <span class="text-blue-600 font-bold text-sm">
                                    {{ $article->published_at->format('d M') }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition line-clamp-2">
                                {{ $article->title }}
                            </h3>

                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ Str::limit($article->excerpt ?? $article->content, 120) }}
                            </p>

                            @if($article->tags->isNotEmpty())
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach($article->tags->take(2) as $tag)
                                        <span class="inline-block bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
                                            #{{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <a href="{{ route('news.show', $article) }}"
                               class="inline-flex items-center text-blue-600 font-semibold text-sm hover:text-blue-800 transition">
                                Lees Meer <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            @if($news->hasPages())
                <div class="mt-12">
                    {{ $news->links() }}
                </div>
            @endif
        @endif
    </div>
</section>

@endsection

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
