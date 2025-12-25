<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') - B-Pro Services</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-gray-800 text-white flex-shrink-0">
            <div class="p-4 border-b border-gray-700">
                <h2 class="text-xl font-bold">
                    <i class="fas fa-broom mr-2"></i>
                    B-Pro Admin
                </h2>
            </div>

            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition
                          {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-chart-line w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition
                          {{ request()->routeIs('admin.users.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-users w-5"></i>
                    <span class="ml-3">Gebruikers</span>
                </a>

                <a href="{{ route('admin.news.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition
                          {{ request()->routeIs('admin.news.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-newspaper w-5"></i>
                    <span class="ml-3">Nieuws</span>
                </a>

                <a href="{{ route('admin.tags.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition
                          {{ request()->routeIs('admin.tags.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-tags w-5"></i>
                    <span class="ml-3">Tags</span>
                </a>

                <a href="{{ route('admin.faqs.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition
                          {{ request()->routeIs('admin.faqs.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-question-circle w-5"></i>
                    <span class="ml-3">FAQs</span>
                </a>

                <a href="{{ route('admin.categories.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition
                          {{ request()->routeIs('admin.categories.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-folder w-5"></i>
                    <span class="ml-3">Categorieën</span>
                </a>

                <a href="{{ route('admin.services.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition
                          {{ request()->routeIs('admin.services.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-concierge-bell w-5"></i>
                    <span class="ml-3">Diensten</span>
                </a>

                <a href="{{ route('admin.portfolios.index') }}"
                class="flex items-center px-4 py-3 {{ request()->routeIs('admin.portfolios.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-700' }} rounded-lg transition">
                    <i class="fas fa-images w-5"></i>
                    <span class="ml-3">Portfolio</span>
                </a>

                <a href="{{ route('admin.quotes.index') }}"
                class="flex items-center px-4 py-3 {{ request()->routeIs('admin.quotes.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-700' }} rounded-lg transition">
                    <i class="fas fa-file-invoice w-5"></i>
                    <span class="ml-3">Offerte Aanvragen</span>
                    @if(\App\Models\Quote::where('status', 'new')->count() > 0)
                        <span class="ml-auto px-2 py-1 bg-red-500 text-white text-xs rounded-full">
                            {{ \App\Models\Quote::where('status', 'new')->count() }}
                        </span>
                    @endif
                </a>

                <hr class="border-gray-700 my-4">

                <a href="{{ route('dashboard') }}"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-home w-5"></i>
                    <span class="ml-3">Terug naar site</span>
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">

            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <h1 class="text-2xl font-semibold text-gray-800">
                        @yield('page-title', 'Admin Panel')
                    </h1>

                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">
                            {{ auth()->user()->name }}
                        </span>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800">
                                <i class="fas fa-sign-out-alt mr-1"></i>
                                Uitloggen
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6">

                @if(session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex justify-between items-center shadow-sm" role="alert">
                        <div>
                            <strong class="font-bold">Succes!</strong>
                            <span class="block sm:inline ml-1">{{ session('success') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove();" class="text-green-700 hover:text-green-900 font-bold ml-4 focus:outline-none">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative flex justify-between items-center shadow-sm" role="alert">
                        <div>
                            <strong class="font-bold">Fout!</strong>
                            <span class="block sm:inline ml-1">{{ session('error') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove();" class="text-red-700 hover:text-red-900 font-bold ml-4 focus:outline-none">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative shadow-sm">
                        <div class="flex justify-between items-start">
                            <div>
                                <strong class="font-bold">Er zijn fouten opgetreden:</strong>
                                <ul class="mt-2 list-disc list-inside text-sm">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove();" class="text-red-700 hover:text-red-900 font-bold ml-4 focus:outline-none">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endif

                @yield('content')

            </main>
        </div>

    </div>

</body>
</html>
