<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />
    
        <div class="min-h-screen bg-gradient-to-b from-white to-yellow-400 dark:from-gray-900 dark:to-yellow-600 flex flex-col">
            @livewire('navigation-menu') <!-- TOP NAV -->
    
            <div class="flex flex-1 overflow-hidden">
                @include('sidenav-menu') <!-- Move sidebar OUTSIDE the scrollable content -->
    
                <!-- Main Content Area -->
                <div class="flex-1 flex flex-col overflow-hidden">
                    @if (isset($header))
                        <header class="bg-amber-300 dark:bg-gray-800 shadow-md px-4 py-4">
                            <div class="max-w-7xl mx-auto">
                                {{ $header }}
                            </div>
                        </header>
                    @endif
    
                    <main class="flex-1 overflow-y-auto px-4 py-2">
                        {{ $slot }}
                    </main>
                </div>
            </div>
    
            <!-- Footer -->
            <footer class="bg-white dark:bg-gray-900 border-t border-black dark:border-gray-700">
                <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col sm:flex-row justify-between items-center text-gray-700 dark:text-gray-300">
                    <p class="text-sm">&copy; 2025 Cropwise. All rights reserved.</p>
                    <div class="flex space-x-4 mt-2 sm:mt-0">
                        <a href="#" class="hover:text-blue-500 transition-colors duration-200"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="hover:text-blue-400 transition-colors duration-200"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="hover:text-pink-500 transition-colors duration-200"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </footer>
        </div>
    
        @stack('modals')
        @livewireScripts
    </body>
    
</html>
