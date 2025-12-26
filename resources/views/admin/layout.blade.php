<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') - B-Pro Services</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .sidebar-scroll::-webkit-scrollbar { width: 6px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: #1f2937; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: #374151; border-radius: 3px; }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover { background: #4b5563; }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-72 bg-gray-900 text-white flex-shrink-0 flex flex-col transition-all duration-300">

            <div class="p-6 flex items-center border-b border-gray-800">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3 shadow-lg">
                    <i class="fas fa-broom text-white text-sm"></i>
                </div>
                <h2 class="text-xl font-bold tracking-wide">
                    B-Pro <span class="text-blue-500">Admin</span>
                </h2>
            </div>

            <nav class="flex-1 overflow-y-auto sidebar-scroll py-4 px-3 space-y-1">

                <div class="mb-6">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Overzicht
                    </p>
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center px-3 py-2.5 rounded-lg transition-colors duration-200
                              {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <i class="fas fa-chart-line w-6 text-center"></i>
                        <span class="ml-2 font-medium">Dashboard</span>
                    </a>
                </div>

                <div class="mb-6">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Communicatie
                    </p>

                    <a href="{{ route('admin.quotes.index') }}"
                       class="flex items-center px-3 py-2.5 rounded-lg transition-colors duration-200 mb-1
                              {{ request()->routeIs('admin.quotes.*') ? 'bg-blue-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <i class="fas fa-file-invoice w-6 text-center"></i>
                        <span class="ml-2 font-medium">Offertes</span>

                        @if(\App\Models\Quote::where('status', 'new')->count() > 0)
                            <span class="ml-auto flex items-center justify-center bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                                {{ \App\Models\Quote::where('status', 'new')->count() }}
                            </span>
                        @endif
                    </a>

                    <a href="{{ route('admin.contact-messages.index') }}"
                       class="flex items-center px-3 py-2.5 rounded-lg transition-colors duration-200
                              {{ request()->routeIs('admin.contact-messages.*') ? 'bg-blue-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <i class="fas fa-envelope w-6 text-center"></i>
                        <span class="ml-2 font-medium">Berichten</span>

                        @if(\App\Models\ContactMessage::where('status', 'new')->count() > 0)
                            <span class="ml-auto flex items-center justify-center bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                                {{ \App\Models\ContactMessage::where('status', 'new')->count() }}
                            </span>
                        @endif
                    </a>
                </div>

                <div class="mb-6">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Website Content
                    </p>

                    <a href="{{ route('admin.services.index') }}"
                       class="flex items-center px-3 py-2.5 rounded-lg transition-colors duration-200 mb-1
                              {{ request()->routeIs('admin.services.*') ? 'bg-blue-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <i class="fas fa-concierge-bell w-6 text-center"></i>
                        <span class="ml-2 font-medium">Diensten</span>
                    </a>

                    <a href="{{ route('admin.portfolios.index') }}"
                       class="flex items-center px-3 py-2.5 rounded-lg transition-colors duration-200 mb-1
                              {{ request()->routeIs('admin.portfolios.*') ? 'bg-blue-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <i class="fas fa-images w-6 text-center"></i>
                        <span class="ml-2 font-medium">Portfolio</span>
                    </a>

                    <a href="{{ route('admin.news.index') }}"
                       class="flex items-center px-3 py-2.5 rounded-lg transition-colors duration-200 mb-1
                              {{ request()->routeIs('admin.news.*') ? 'bg-blue-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <i class="fas fa-newspaper w-6 text-center"></i>
                        <span class="ml-2 font-medium">Nieuws</span>
                    </a>
                </div>

                <div class="mb-6">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Systeem & Data
                    </p>

                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center px-3 py-2.5 rounded-lg transition-colors duration-200 mb-1
                              {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <i class="fas fa-users w-6 text-center"></i>
                        <span class="ml-2 font-medium">Gebruikers</span>
                    </a>

                    <a href="{{ route('admin.categories.index') }}"
                       class="flex items-center px-3 py-2.5 rounded-lg transition-colors duration-200 mb-1
                              {{ request()->routeIs('admin.categories.*') ? 'bg-blue-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <i class="fas fa-folder w-6 text-center"></i>
                        <span class="ml-2 font-medium">Categorieën</span>
                    </a>

                    <a href="{{ route('admin.tags.index') }}"
                       class="flex items-center px-3 py-2.5 rounded-lg transition-colors duration-200 mb-1
                              {{ request()->routeIs('admin.tags.*') ? 'bg-blue-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <i class="fas fa-tags w-6 text-center"></i>
                        <span class="ml-2 font-medium">Tags</span>
                    </a>

                    <a href="{{ route('admin.faqs.index') }}"
                       class="flex items-center px-3 py-2.5 rounded-lg transition-colors duration-200 mb-1
                              {{ request()->routeIs('admin.faqs.*') ? 'bg-blue-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <i class="fas fa-question-circle w-6 text-center"></i>
                        <span class="ml-2 font-medium">FAQs</span>
                    </a>

                    <a href="{{ route('admin.settings.index') }}"
                       class="flex items-center px-3 py-2.5 rounded-lg transition-colors duration-200
                              {{ request()->routeIs('admin.settings.*') ? 'bg-blue-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <i class="fas fa-cog w-6 text-center"></i>
                        <span class="ml-2 font-medium">Instellingen</span>
                    </a>
                </div>

            </nav>

            <div class="p-4 border-t border-gray-800 bg-gray-900">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center justify-center w-full px-4 py-2 bg-gray-800 hover:bg-gray-700 text-gray-300 rounded-lg transition duration-200">
                    <i class="fas fa-external-link-alt text-sm mr-2"></i>
                    <span class="text-sm font-medium">Bekijk Website</span>
                </a>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden relative">

            <header class="bg-white shadow-sm border-b border-gray-200 z-10">
                <div class="flex items-center justify-between px-6 py-3">

                    <h1 class="text-xl font-bold text-gray-800">
                        @yield('page-title', 'Admin Panel')
                    </h1>

                    <div class="flex items-center space-x-4">

                        <div class="flex items-center">
                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold mr-2">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-medium text-gray-700">
                                {{ auth()->user()->name }}
                            </span>
                        </div>

                        <div class="h-6 w-px bg-gray-300"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="text-sm text-red-600 hover:text-red-800 font-medium flex items-center transition"
                                    onclick="this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt mr-1"></i>
                                Uitloggen
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">

                @if(session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm flex justify-between items-center" role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-3 text-lg"></i>
                            <div>
                                <p class="font-bold">Succes</p>
                                <p class="text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                        <button onclick="this.parentElement.remove();" class="text-green-700 hover:text-green-900">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm flex justify-between items-center" role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-3 text-lg"></i>
                            <div>
                                <p class="font-bold">Foutmelding</p>
                                <p class="text-sm">{{ session('error') }}</p>
                            </div>
                        </div>
                        <button onclick="this.parentElement.remove();" class="text-red-700 hover:text-red-900">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle mr-3 mt-1"></i>
                            <div>
                                <p class="font-bold">Er zijn fouten opgetreden:</p>
                                <ul class="list-disc list-inside text-sm mt-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')

            </main>
        </div>
    </div>

</body>
</html>
