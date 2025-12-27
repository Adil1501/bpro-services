@extends('frontend.layouts.app')

@section('title', 'Portfolio - Ons Werk - B-Pro Services')
@section('description', 'Bekijk onze afgeronde projecten en voor/na transformaties. Ontdek de kwaliteit van B-Pro Services.')

@section('content')

<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Ons Portfolio
            </h1>
            <p class="text-xl text-blue-100">
                Bekijk onze afgeronde projecten en overtuig uzelf van onze kwaliteit
            </p>
        </div>
    </div>
</section>

<section class="bg-white border-b sticky top-0 z-40 shadow-sm">
    <div class="container mx-auto px-4 py-4">
        <div class="flex flex-wrap items-center justify-center gap-3">
            <a href="{{ route('portfolio') }}"
               class="px-6 py-2 rounded-full font-semibold transition {{ !request('category') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <i class="fas fa-th mr-2"></i>
                Alles ({{ \App\Models\Portfolio::count() }})
            </a>

            @foreach($categories as $category)
                <a href="{{ route('portfolio', ['category' => $category->id]) }}"
                   class="px-6 py-2 rounded-full font-semibold transition {{ request('category') == $category->id ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ $category->name }} ({{ $category->portfolioProjects->count() }})
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">

        @if($portfolios->isEmpty())
            <div class="max-w-2xl mx-auto text-center py-12">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-images text-gray-400 text-5xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Nog geen projecten in deze categorie</h2>
                <p class="text-gray-600 mb-6">Bekijk onze andere categorieën of kom later terug!</p>
                <a href="{{ route('portfolio') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Terug naar Alle Projecten
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($portfolios as $project)
                    <div class="group cursor-pointer" onclick="openLightbox({{ $project->id }})">
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300">
                            <div class="relative aspect-video overflow-hidden bg-gray-900">
                                <img src="{{ Storage::url($project->before_image) }}"
                                     alt="{{ $project->title }} - Voor"
                                     class="w-full h-full object-cover transition-opacity duration-300 group-hover:opacity-0">

                                <img src="{{ Storage::url($project->after_image) }}"
                                     alt="{{ $project->title }} - Na"
                                     class="absolute inset-0 w-full h-full object-cover opacity-0 group-hover:opacity-100 transition-opacity duration-300">

                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="absolute bottom-4 left-4 right-4">
                                        <div class="flex items-center justify-between text-white text-sm font-semibold">
                                            <span class="bg-blue-600 px-3 py-1 rounded-full">VOOR</span>
                                            <i class="fas fa-arrows-alt-h"></i>
                                            <span class="bg-green-600 px-3 py-1 rounded-full">NA</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="absolute top-4 right-4 w-10 h-10 bg-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                                    <i class="fas fa-search-plus text-blue-600"></i>
                                </div>

                                @if($project->category)
                                    <div class="absolute top-4 left-4 bg-white px-3 py-1 rounded-full text-xs font-semibold text-gray-900 shadow-md">
                                        {{ $project->category->name }}
                                    </div>
                                @endif
                            </div>

                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition">
                                    {{ $project->title }}
                                </h3>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ $project->description }}
                                </p>

                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    @if($project->location)
                                        <span class="flex items-center">
                                            <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>
                                            {{ $project->location }}
                                        </span>
                                    @endif

                                    @if($project->completed_at)
                                        <span class="flex items-center">
                                            <i class="fas fa-calendar mr-2 text-blue-600"></i>
                                            {{ $project->completed_at->format('M Y') }}
                                        </span>
                                    @endif
                                </div>

                                @auth
                                    <button onclick="toggleLike({{ $project->id }})"
                                            id="like-btn-{{ $project->id }}"
                                            class="mt-4 flex items-center text-sm transition {{ $project->isLikedByUser(auth()->id()) ? 'text-red-500' : 'text-gray-600 hover:text-red-500' }}">
                                        <i id="like-icon-{{ $project->id }}"
                                        class="fas fa-heart mr-2 {{ $project->isLikedByUser(auth()->id()) ? 'text-red-500' : '' }}"></i>
                                        <span id="like-count-{{ $project->id }}">{{ $project->likes_count }} {{ $project->likes_count == 1 ? 'like' : 'likes' }}</span>
                                    </button>
                                @else
                                    <div class="mt-4 flex items-center text-sm text-gray-600">
                                        <i class="fas fa-heart mr-2"></i>
                                        <span>{{ $project->likes_count }} {{ $project->likes_count == 1 ? 'like' : 'likes' }}</span>
                                        <a href="{{ route('login') }}" class="ml-2 text-xs text-blue-600 hover:underline">
                                            (Log in om te liken)
                                        </a>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($portfolios->hasPages())
                <div class="mt-12">
                    {{ $portfolios->links() }}
                </div>
            @endif
        @endif
    </div>
</section>

<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-95 z-50 hidden items-center justify-center p-4">
    <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-4xl hover:text-gray-300 transition z-10">
        <i class="fas fa-times"></i>
    </button>

    <div class="max-w-6xl w-full">
        <div id="lightbox-content" class="bg-white rounded-lg overflow-hidden">
        </div>
    </div>
</div>

<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl shadow-2xl p-12 text-center text-white">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Klaar Voor Een Transformatie?
            </h2>
            <p class="text-xl text-blue-100 mb-8">
                Laat uw ruimte ook stralen! Vraag een vrijblijvende offerte aan.
            </p>
            <a href="{{ route('quote.create') }}"
               class="inline-block px-8 py-4 bg-white text-blue-600 rounded-lg font-bold hover:bg-blue-50 transition shadow-lg">
                <i class="fas fa-file-invoice mr-2"></i>
                Vraag Gratis Offerte Aan
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    const portfolioData = [
        @foreach($portfolios as $p)
        {
            id: {{ $p->id }},
            title: "{{ addslashes($p->title) }}",
            description: "{{ addslashes($p->description) }}",
            before_image: "{{ Storage::url($p->before_image) }}",
            after_image: "{{ Storage::url($p->after_image) }}",
            category: "{{ $p->category ? addslashes($p->category->name) : '' }}",
            location: "{{ $p->location ? addslashes($p->location) : '' }}",
            completed_at: "{{ $p->completed_at ? $p->completed_at->format('F Y') : '' }}",
            likes: {{ $p->likes_count }}
        }{{ $loop->last ? '' : ',' }}
        @endforeach
    ];

    function openLightbox(projectId) {
        const project = portfolioData.find(p => p.id === projectId);
        if (!project) return;

        const lightbox = document.getElementById('lightbox');
        const content = document.getElementById('lightbox-content');

        content.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2">
                <!-- Before Image -->
                <div class="relative bg-gray-900">
                    <img src="${project.before_image}" alt="Voor" class="w-full h-full object-cover">
                    <div class="absolute bottom-4 left-4 bg-blue-600 text-white px-4 py-2 rounded-lg font-bold">
                        <i class="fas fa-arrow-left mr-2"></i>VOOR
                    </div>
                </div>

                <!-- After Image -->
                <div class="relative bg-gray-900">
                    <img src="${project.after_image}" alt="Na" class="w-full h-full object-cover">
                    <div class="absolute bottom-4 right-4 bg-green-600 text-white px-4 py-2 rounded-lg font-bold">
                        NA<i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </div>
            </div>

            <!-- Info -->
            <div class="p-8">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">${project.title}</h2>
                        ${project.category ? `<span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">${project.category}</span>` : ''}
                    </div>
                </div>

                <p class="text-gray-600 mb-6 leading-relaxed">${project.description}</p>

                <div class="flex flex-wrap gap-6 text-sm text-gray-500">
                    ${project.location ? `
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>
                            <span>${project.location}</span>
                        </div>
                    ` : ''}

                    ${project.completed_at ? `
                        <div class="flex items-center">
                            <i class="fas fa-calendar mr-2 text-blue-600"></i>
                            <span>${project.completed_at}</span>
                        </div>
                    ` : ''}

                    <div class="flex items-center">
                        <i class="fas fa-heart mr-2 text-red-500"></i>
                        <span>${project.likes} likes</span>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t">
                    <a href="{{ route('quote.create') }}" class="inline-block bg-blue-600 text-white px-8 py-4 rounded-lg font-bold hover:bg-blue-700 transition">
                        <i class="fas fa-file-invoice mr-2"></i>
                        Vraag Ook Een Offerte Aan
                    </a>
                </div>
            </div>
        `;

        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    async function toggleLike(portfolioId) {
        const button = document.getElementById(`like-btn-${portfolioId}`);
        const icon = document.getElementById(`like-icon-${portfolioId}`);
        const count = document.getElementById(`like-count-${portfolioId}`);

        button.disabled = true;
        button.style.opacity = '0.5';

        try {
            const response = await fetch(`/portfolio/${portfolioId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const data = await response.json();

            if (data.success) {
                count.textContent = `${data.likes} ${data.likes == 1 ? 'like' : 'likes'}`;

                if (data.liked) {
                    button.classList.remove('text-gray-600');
                    button.classList.add('text-red-500');
                    icon.classList.add('text-red-500');
                } else {
                    button.classList.remove('text-red-500');
                    button.classList.add('text-gray-600');
                    icon.classList.remove('text-red-500');
                }

                showToast(data.message);
            } else {
                alert(data.message);
            }
        } catch (error) {
            console.error('Like error:', error);
            alert('Er ging iets mis. Probeer het opnieuw.');
        } finally {
            button.disabled = false;
            button.style.opacity = '1';
        }
    }

    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'fixed bottom-4 right-4 bg-gray-900 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in';
        toast.textContent = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transition = 'opacity 0.3s';
            setTimeout(() => toast.remove(), 300);
        }, 2000);
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        }
    });

    document.getElementById('lightbox')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeLightbox();
        }
    });
</script>
@endpush

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .animate-fade-in {
        animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    button:disabled {
        cursor: not-allowed;
    }
</style>
@endpush
