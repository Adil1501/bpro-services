@extends('frontend.layouts.app')

@section('title', $news->title . ' - B-Pro Services')
@section('description', Str::limit($news->excerpt ?? $news->content, 160))

@section('content')

<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <nav class="mb-6">
                <ol class="flex items-center space-x-2 text-sm text-blue-200">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li><a href="{{ route('news.index') }}" class="hover:text-white transition">Nieuws</a></li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-white">{{ Str::limit($news->title, 50) }}</li>
                </ol>
            </nav>

            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                {{ $news->title }}
            </h1>

            <div class="flex flex-wrap items-center gap-4 text-blue-100">
                <span class="flex items-center">
                    <i class="fas fa-calendar mr-2"></i>
                    {{ $news->published_at->format('d F Y') }}
                </span>
                <span class="flex items-center">
                    <i class="fas fa-clock mr-2"></i>
                    {{ ceil(str_word_count(strip_tags($news->content)) / 200) }} min lezen
                </span>
                @if($news->author)
                    <span class="flex items-center">
                        <i class="fas fa-user mr-2"></i>
                        {{ $news->author }}
                    </span>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">

            @if($news->image)
                <div class="rounded-2xl overflow-hidden shadow-xl mb-12">
                    <img src="{{ Storage::url($news->image) }}"
                         alt="{{ $news->title }}"
                         class="w-full h-auto">
                </div>
            @endif

            <article class="bg-white rounded-xl shadow-md p-8 md:p-12 mb-8">
                @if($news->excerpt)
                    <div class="text-xl text-gray-600 italic mb-8 pb-8 border-b border-gray-200">
                        {{ $news->excerpt }}
                    </div>
                @endif

                <div class="prose prose-lg max-w-none">
                    {!! nl2br(e($news->content)) !!}
                </div>

                @if($news->tags->isNotEmpty())
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($news->tags as $tag)
                                <span class="inline-block bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium">
                                    #{{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </article>

            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Deel dit artikel</h3>
                <div class="flex gap-3">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.show', $news)) }}"
                       target="_blank"
                       class="flex items-center justify-center w-12 h-12 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('news.show', $news)) }}&text={{ urlencode($news->title) }}"
                       target="_blank"
                       class="flex items-center justify-center w-12 h-12 bg-blue-400 text-white rounded-lg hover:bg-blue-500 transition">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('news.show', $news)) }}&title={{ urlencode($news->title) }}"
                       target="_blank"
                       class="flex items-center justify-center w-12 h-12 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition">
                        <i class="fab fa-linkedin text-xl"></i>
                    </a>
                    <button onclick="copyToClipboard('{{ route('news.show', $news) }}')"
                            class="flex items-center justify-center w-12 h-12 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                        <i class="fas fa-link text-xl"></i>
                    </button>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('news.index') }}"
                   class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Terug naar Nieuws Overzicht
                </a>
            </div>
        </div>
    </div>
</section>

@php
    $relatedNews = \App\Models\News::where('is_published', true)
                                   ->where('published_at', '<=', now())
                                   ->where('id', '!=', $news->id)
                                   ->latest('published_at')
                                   ->take(3)
                                   ->get();
@endphp

@if($relatedNews->isNotEmpty())
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Meer Nieuws</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedNews as $article)
                        <article class="bg-gray-50 rounded-xl overflow-hidden hover:shadow-lg transition group">
                            <div class="relative h-48 bg-gray-200">
                                @if($article->image)
                                    <img src="{{ Storage::url($article->image) }}"
                                         alt="{{ $article->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                @endif
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition line-clamp-2">
                                    {{ $article->title }}
                                </h3>
                                <p class="text-gray-600 text-sm mb-4">
                                    {{ $article->published_at->format('d M Y') }}
                                </p>
                                <a href="{{ route('news.show', $article) }}"
                                   class="text-blue-600 font-semibold text-sm hover:text-blue-800 transition">
                                    Lees Meer →
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif

@endsection

@push('scripts')
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Link gekopieerd naar klembord!');
    }, function(err) {
        console.error('Kon link niet kopiëren: ', err);
    });
}
</script>
@endpush
