<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">

            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center group-hover:bg-blue-700 transition">
                    <i class="fas fa-broom text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">B-Pro Services</h1>
                    <p class="text-sm text-gray-600">Professionele Schoonmaak</p>
                </div>
            </a>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->routeIs('home') ? 'text-blue-600' : '' }}">
                    Home
                </a>
                <a href="{{ route('services') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->routeIs('services*') ? 'text-blue-600' : '' }}">
                    Diensten
                </a>
                <a href="{{ route('portfolio') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->routeIs('portfolio') ? 'text-blue-600' : '' }}">
                    Portfolio
                </a>
                <a href="{{ route('news.index') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->routeIs('news*') ? 'text-blue-600' : '' }}">
                    Nieuws
                </a>
                <a href="{{ route('faq') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->routeIs('faq') ? 'text-blue-600' : '' }}">
                    FAQ
                </a>
                <a href="{{ route('contact') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->routeIs('contact') ? 'text-blue-600' : '' }}">
                    Contact
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('quote.create') }}"
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <i class="fas fa-file-invoice mr-2"></i>
                    Offerte Aanvragen
                </a>

                @auth
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}"
                       class="text-gray-700 hover:text-blue-600">
                        <i class="fas fa-user-circle text-2xl"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="text-gray-700 hover:text-blue-600 font-medium">
                        Login
                    </a>
                @endauth
            </div>

            <button id="mobile-menu-button" class="md:hidden text-gray-700 hover:text-blue-600 focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <div id="mobile-menu" class="hidden md:hidden pb-4">
            <div class="flex flex-col space-y-3">
                <a href="{{ route('home') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium py-2 {{ request()->routeIs('home') ? 'text-blue-600' : '' }}">
                    Home
                </a>
                <a href="{{ route('services') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium py-2 {{ request()->routeIs('services*') ? 'text-blue-600' : '' }}">
                    Diensten
                </a>
                <a href="{{ route('portfolio') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium py-2 {{ request()->routeIs('portfolio') ? 'text-blue-600' : '' }}">
                    Portfolio
                </a>
                <a href="{{ route('news.index') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium py-2 {{ request()->routeIs('news*') ? 'text-blue-600' : '' }}">
                    Nieuws
                </a>
                <a href="{{ route('faq') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium py-2 {{ request()->routeIs('faq') ? 'text-blue-600' : '' }}">
                    FAQ
                </a>
                <a href="{{ route('contact') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium py-2 {{ request()->routeIs('contact') ? 'text-blue-600' : '' }}">
                    Contact
                </a>
                <a href="{{ route('quote.create') }}"
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold text-center hover:bg-blue-700 transition">
                    <i class="fas fa-file-invoice mr-2"></i>
                    Offerte Aanvragen
                </a>
                @auth
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}"
                       class="text-gray-700 hover:text-blue-600 font-medium py-2">
                        <i class="fas fa-user-circle mr-2"></i>Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="text-gray-700 hover:text-blue-600 font-medium py-2">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
