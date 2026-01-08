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
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                                class="flex items-center px-4 py-3 bg-gray-100 hover:bg-gray-200 rounded-lg transition focus:outline-none">
                            <i class="fas fa-user-circle text-xl mr-2 text-gray-700"></i>
                            <span class="font-medium text-gray-700">{{ Str::limit(auth()->user()->name, 15) }}</span>
                            <i class="fas fa-chevron-down ml-2 text-sm text-gray-600 transition-transform" :class="{ 'rotate-180': open }"></i>
                        </button>

                        <div x-show="open"
                            @click.away="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-100">

                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                            </div>

                            <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}"
                            class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                <i class="fas fa-home w-5 mr-3"></i>
                                <span>Dashboard</span>
                            </a>

                            @if(auth()->user()->username)
                                <a href="{{ route('profile.show', auth()->user()->username) }}"
                                class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                    <i class="fas fa-id-card w-5 mr-3"></i>
                                    <span>Bekijk Profiel</span>
                                </a>
                            @endif

                            @if(!auth()->user()->isAdmin())
                                <a href="{{ route('profile.edit') }}"
                                class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                    <i class="fas fa-user-cog w-5 mr-3"></i>
                                    <span>Instellingen</span>
                                </a>
                            @endif

                            <div class="border-t border-gray-100 my-2"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="flex items-center w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition">
                                    <i class="fas fa-sign-out-alt w-5 mr-3"></i>
                                    <span>Uitloggen</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                    class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:border-gray-400 hover:bg-gray-50 transition">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                    class="px-6 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition shadow-md">
                        <i class="fas fa-user-plus mr-2"></i>
                        Registreer
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
                <a href="{{ route('contact') }}"
                class="text-gray-700 hover:text-blue-600 font-medium py-2 {{ request()->routeIs('contact') ? 'text-blue-600' : '' }}">
                    Contact
                </a>

                <div class="border-t border-gray-200 my-2"></div>

                <a href="{{ route('quote.create') }}"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold text-center hover:bg-blue-700 transition shadow-md">
                    <i class="fas fa-file-invoice mr-2"></i>
                    Offerte Aanvragen
                </a>

                @auth
                    <div class="border-t border-gray-200 pt-3">
                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-3 px-2">Mijn Account</p>

                        <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}"
                        class="flex items-center text-gray-700 hover:text-blue-600 font-medium py-2 px-2">
                            <i class="fas fa-user-circle mr-3"></i>
                            Dashboard
                        </a>

                        @if(auth()->user()->username)
                            <a href="{{ route('profile.show', auth()->user()->username) }}"
                            class="flex items-center text-gray-700 hover:text-blue-600 font-medium py-2 px-2">
                                <i class="fas fa-id-card mr-3"></i>
                                Bekijk Profiel
                            </a>
                        @endif

                        @if(!auth()->user()->isAdmin())
                            <a href="{{ route('profile.edit') }}"
                            class="flex items-center text-gray-700 hover:text-blue-600 font-medium py-2 px-2">
                                <i class="fas fa-user-cog mr-3"></i>
                                Instellingen
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" class="mt-3">
                            @csrf
                            <button type="submit"
                                    class="flex items-center justify-center w-full bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Uitloggen
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex flex-col space-y-3">
                        <a href="{{ route('login') }}"
                        class="border-2 border-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold text-center hover:border-gray-400 hover:bg-gray-50 transition">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                        class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold text-center hover:bg-green-700 transition shadow-md">
                            <i class="fas fa-user-plus mr-2"></i>
                            Registreer Nu
                        </a>
                    </div>
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
