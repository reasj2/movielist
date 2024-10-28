<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta Tags & CSRF Token -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MovieList') }}</title>
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-b from-orange-100 to-orange-200 dark:from-gray-900 dark:to-gray-800">
    <div class="font-sans text-gray-900 antialiased">
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
