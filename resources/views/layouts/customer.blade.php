<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ArtemVita')</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-white text-black px-6 py-4 flex flex-wrap items-center justify-between border border-gray-300 shadow-md">
        <!-- Logo -->
        <div class="flex-shrink-0">
            <a href="/">
                <img src="{{ asset('favicon-32x32.png') }}" alt="ArtemVita Logo" class="h-8 w-8"> 
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="flex space-x-4 mb-2 sm:mb-0">
            <a href="/" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-lg transition duration-300">Home</a>
            <a href="/products" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-lg transition duration-300">Products</a>
            <a href="/painting_dashboard" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-lg transition duration-300">Dashboard</a>
            <a href="/profile" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-lg transition duration-300">Profile</a>
            <a href="/cart" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-lg transition duration-300">Cart</a>
        </nav>

        <!-- Livewire Search Bar -->
        @livewire('search-bar')

    </header>

    @include('frontend_component/register-prompt')
    <!-- Main Content -->
    <main class="container mx-auto mt-8 px-4 flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white text-gray-700 border-t border-gray-300 shadow-md mt-8">
        <div class="container mx-auto px-6 py-6 flex flex-col md:flex-row items-center justify-between">
            <!-- Left Side: Brand & Copyright -->
            <div class="text-center md:text-left mb-6 md:mb-0">
                <img src="{{ asset('favicon-32x32.png') }}" alt="ArtemVita Logo" class="h-8 w-8">
                <span class="text-lg font-bold">ArtemVita</span> <br>
                <p class="text-sm text-gray-500">&copy; {{ date('Y') }} All rights reserved.</p>
            </div>

            <!-- Navigation Links (Now Vertical) -->
            <div class="flex flex-col space-y-2 text-center md:text-left">
                <a href="/" class="text-gray-600 hover:text-blue-500 text-sm transition">Home</a>
                <a href="/products" class="text-gray-600 hover:text-blue-500 text-sm transition">Products</a>
                <a href="/about" class="text-gray-600 hover:text-blue-500 text-sm transition">About</a>
                <a href="/contact" class="text-gray-600 hover:text-blue-500 text-sm transition">Contact</a>
            </div>

            
        </div>
    </footer>


    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>
