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

        <div class="min-h-screen bg-gradient-to-b from-white to-yellow-400 dark:from-gray-900 dark:to-yellow-600 flex flex-col ">
            @livewire('navigation-menu') <!-- TOP NAV -->
        
            <div class="flex">
                @include('sidenav-menu') <!-- SIDE NAV -->
        
                <!-- Main Content -->
                <div class="flex-1 p-2 overflow-y-auto">
                    @if (isset($header))
                        <header class="bg-amber-300 dark:bg-gray-800 shadow-lg rounded-lg border border-black">
                            <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endif
        
                    <main >
                        {{ $slot }}
                    </main>

                </div>
            </div>
            <footer class="bg-white p-6 border border-black "><p class="self-center">All rights reserved. Cropwise 2025</p></footer>

        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
