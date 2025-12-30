<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Cropwise') }} - Elite Agricultural Management</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-slate-950 text-slate-200" x-data="{ sidebarOpen: false }">
        <x-banner />
    
        <div class="min-h-screen flex flex-col bg-[radial-gradient(ellipse_at_top_left,_var(--tw-gradient-stops))] from-primary-900 via-slate-950 to-black relative">
            @livewire('navigation-menu')

            <!-- Mobile Sidebar Overlay -->
            <template x-if="sidebarOpen">
                <div class="fixed inset-0 z-40 bg-black/60 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false"></div>
            </template>

            <div class="flex flex-1 overflow-hidden relative">
                <!-- Background Decorative Elements -->
                <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
                    <div class="absolute top-[-10%] left-[-5%] w-[40%] h-[40%] bg-primary-600/10 blur-[120px] rounded-full"></div>
                    <div class="absolute bottom-[-10%] right-[-5%] w-[30%] h-[30%] bg-accent-600/5 blur-[100px] rounded-full"></div>
                </div>

                <!-- Sidenav include with responsive class -->
                <div class="fixed inset-y-0 left-0 z-50 transform lg:relative lg:translate-x-0 transition duration-300 ease-in-out"
                     :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
                    @include('sidenav-menu')
                </div>

                <!-- Main Content Area -->
                <div class="flex-1 flex flex-col min-w-0 overflow-hidden z-10">
                    @if (isset($header))
                        <header class="bg-white/5 backdrop-blur-md border-b border-white/10 px-4 sm:px-8 py-6">
                            <div class="max-w-7xl mx-auto flex items-center">
                                <!-- Mobile Menu Toggle -->
                                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden mr-4 text-slate-400 hover:text-white transition-colors">
                                    <i class="fas fa-bars text-xl"></i>
                                </button>
                                <div class="flex-1">
                                    {{ $header }}
                                </div>
                            </div>
                        </header>
                    @endif
    
                    <main class="flex-1 overflow-y-auto px-4 sm:px-8 py-8 scrollbar-hide">
                        <div class="max-w-7xl mx-auto">
                            {{ $slot }}
                        </div>
                    </main>
                </div>
            </div>
    
            <!-- Footer -->
            <footer class="bg-black/40 backdrop-blur-md border-t border-white/5 py-6">
                <div class="max-w-7xl mx-auto px-8 flex flex-col sm:flex-row justify-between items-center text-slate-500">
                    <p class="text-xs uppercase tracking-widest font-semibold">&copy; 2025 Cropwise Elite. Precision Agriculture.</p>
                    <div class="flex space-x-6 mt-4 sm:mt-0">
                        <a href="#" class="hover:text-primary-400 transition-colors duration-300"><i class="fab fa-facebook-f text-sm"></i></a>
                        <a href="#" class="hover:text-primary-400 transition-colors duration-300"><i class="fab fa-twitter text-sm"></i></a>
                        <a href="#" class="hover:text-primary-400 transition-colors duration-300"><i class="fab fa-instagram text-sm"></i></a>
                    </div>
                </div>
            </footer>
        </div>
    
        @stack('modals')
        @livewireScripts

        <style>
            .scrollbar-hide::-webkit-scrollbar {
                display: none;
            }
            .scrollbar-hide {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        </style>
    </body>
</html>
