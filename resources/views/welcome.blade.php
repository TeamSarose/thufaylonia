<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Welcome to Thufaylonia - Your ultimate tourism platform">

        <title>{{ config('app.name', 'Thufaylonia') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="text-gray-200 min-h-screen flex flex-col bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1526772662000-3f88f10405ff?q=80&w=2070&auto=format&fit=crop')">
        <div class="absolute inset-0 bg-black opacity-50"></div> <!-- Overlay -->

        <!-- Navigation Bar -->
        <header class="relative z-10 bg-white/20 dark:bg-gray-900/20 backdrop-blur-md shadow-lg">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo / Site name -->
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center">
                            <span class="text-2xl font-bold font-serif text-white">Thufaylonia</span>
                        </a>
                    </div>
                    
                    <!-- Navigation Links -->
                    <div class="flex items-center">
                        <nav class="flex space-x-4">
                            @if (Route::has('login'))
                                <div class="flex items-center space-x-2 sm:space-x-4">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" 
                                           class="text-white hover:text-indigo-300 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                            Dashboard
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" 
                                           class="text-white hover:text-indigo-300 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                            Login
                                        </a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" 
                                               class="bg-indigo-500 text-white hover:bg-indigo-600 px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200 shadow-md">
                                                Register
                                            </a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <main class="relative z-10 flex-grow flex items-center justify-center">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-24">
                <div class="max-w-4xl mx-auto text-center bg-black/30 backdrop-blur-lg p-8 sm:p-16 rounded-2xl shadow-2xl border border-white/10">
                    <h1 class="text-5xl sm:text-6xl md:text-7xl font-bold font-serif text-white mb-6 leading-tight">
                        Explore <span class="text-indigo-400">Thufaylonia</span>
                    </h1>
                    
                    <p class="text-xl text-gray-300 mb-12 max-w-2xl mx-auto">
                        Your journey into breathtaking landscapes and unforgettable cultural experiences begins here. Let's create memories that will last a lifetime.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('login') }}" 
                           class="inline-flex justify-center items-center px-8 py-4 border border-transparent text-lg font-semibold rounded-lg shadow-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-gray-900 transition-transform transform hover:scale-105 duration-300">
                            Get Started
                        </a>
                        <a href="{{ route('register') }}" 
                           class="inline-flex justify-center items-center px-8 py-4 border border-indigo-400 text-lg font-semibold rounded-lg text-indigo-300 bg-white/10 hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-gray-900 transition-all transform hover:scale-105 duration-300">
                            Register
                        </a>
                    </div>
                </div>
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="relative z-10 bg-black/20 backdrop-blur-md py-6">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-center text-gray-400 text-sm">
                    &copy; {{ date('Y') }} Thufaylonia. All rights reserved.
                </p>
            </div>
        </footer>
    </body>
</html>
