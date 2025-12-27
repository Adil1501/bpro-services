<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'B-Pro Services - Professionele Schoonmaakdiensten')</title>
    <meta name="description" content="@yield('description', 'B-Pro Services levert professionele schoonmaakdiensten voor bedrijven en particulieren in België.')">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @stack('styles')
</head>
<body class="bg-gray-50">

    @include('frontend.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('frontend.partials.footer')

    @stack('scripts')

</body>
</html>
