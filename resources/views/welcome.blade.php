<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CropWise - Smart Agricultural Management</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            .bg-pattern {
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23F53003' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
            .hero-gradient {
                background: linear-gradient(135deg, rgba(245, 48, 3, 0.1) 0%, rgba(27, 27, 24, 0.1) 100%);
            }
            .feature-card {
                transition: transform 0.3s ease;
            }
            .feature-card:hover {
                transform: translateY(-5px);
            }
            .decorative-circle {
                position: absolute;
                border-radius: 50%;
                opacity: 0.1;
            }
        </style>
    </head>
    <body class="antialiased bg-[#FDFDFC] dark:bg-[#161615]">
        <div class="relative min-h-screen">
            <!-- Navigation -->
            <nav class="bg-white/80 dark:bg-[#0a0a0a]/80 backdrop-blur-sm border-b border-[#e3e3e0] dark:border-[#3E3E3A] sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <span class="text-2xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">CropWise</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#1b1b18] dark:hover:text-[#EDEDEC] transition-colors">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#1b1b18] dark:hover:text-[#EDEDEC] transition-colors">Log in</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#1b1b18] dark:hover:text-[#EDEDEC] transition-colors">Register</a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <div class="relative overflow-hidden bg-pattern">
                <div class="decorative-circle w-96 h-96 bg-[#F53003] -top-48 -right-48"></div>
                <div class="decorative-circle w-64 h-64 bg-[#1b1b18] -bottom-32 -left-32"></div>
                <div class="max-w-7xl mx-auto">
                    <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                        <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                            <div class="sm:text-center lg:text-left">
                                <div class="inline-block px-4 py-2 rounded-full bg-[#F53003]/10 dark:bg-[#F61500]/10 text-[#F53003] dark:text-[#F61500] text-sm font-medium mb-4">
                                    Agricultural Management System
                                </div>
                                <h1 class="text-4xl tracking-tight font-extrabold text-[#1b1b18] dark:text-[#EDEDEC] sm:text-5xl md:text-6xl">
                                    <span class="block">Smart Farming</span>
                                    <span class="block text-[#F53003] dark:text-[#F61500]">Made Simple</span>
                                </h1>
                                <p class="mt-3 text-base text-[#706f6c] dark:text-[#A1A09A] sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                                    Manage your farm operations, track inventory, monitor crops, and optimize your agricultural business with our comprehensive management system.
                                </p>
                                <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                    <div class="rounded-md shadow">
                                        <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#1b1b18] dark:bg-[#EDEDEC] hover:bg-black dark:hover:bg-white dark:text-[#1b1b18] transition-colors md:py-4 md:text-lg md:px-10">
                                            Get Started
                                        </a>
                                    </div>
                                    <div class="mt-3 sm:mt-0 sm:ml-3">
                                        <a href="#features" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-[#1b1b18] dark:text-[#EDEDEC] bg-white dark:bg-[#0a0a0a] hover:bg-[#dbdbd7] dark:hover:bg-[#3E3E3A] transition-colors md:py-4 md:text-lg md:px-10">
                                            Learn More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div id="features" class="py-12 bg-white dark:bg-[#0a0a0a]">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="lg:text-center">
                        <div class="inline-block px-4 py-2 rounded-full bg-[#F53003]/10 dark:bg-[#F61500]/10 text-[#F53003] dark:text-[#F61500] text-sm font-medium mb-4">
                            Features
                        </div>
                        <h2 class="text-3xl leading-8 font-extrabold tracking-tight text-[#1b1b18] dark:text-[#EDEDEC] sm:text-4xl">
                            Everything you need to manage your farm
                        </h2>
                    </div>

                    <div class="mt-10">
                        <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                            <!-- Feature 1 -->
                            <div class="relative feature-card p-6 rounded-lg bg-white dark:bg-[#0a0a0a] shadow-sm hover:shadow-md transition-all">
                                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#1b1b18]">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <div class="ml-16">
                                    <h3 class="text-lg leading-6 font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Crop Management</h3>
                                    <p class="mt-2 text-base text-[#706f6c] dark:text-[#A1A09A]">
                                        Track planting schedules, monitor growth, and manage harvest cycles efficiently.
                                    </p>
                                </div>
                            </div>

                            <!-- Feature 2 -->
                            <div class="relative feature-card p-6 rounded-lg bg-white dark:bg-[#0a0a0a] shadow-sm hover:shadow-md transition-all">
                                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#1b1b18]">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <div class="ml-16">
                                    <h3 class="text-lg leading-6 font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Inventory Control</h3>
                                    <p class="mt-2 text-base text-[#706f6c] dark:text-[#A1A09A]">
                                        Manage seeds, fertilizers, equipment, and other farm supplies with ease.
                                    </p>
                                </div>
                            </div>

                            <!-- Feature 3 -->
                            <div class="relative feature-card p-6 rounded-lg bg-white dark:bg-[#0a0a0a] shadow-sm hover:shadow-md transition-all">
                                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#1b1b18]">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="ml-16">
                                    <h3 class="text-lg leading-6 font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Financial Tracking</h3>
                                    <p class="mt-2 text-base text-[#706f6c] dark:text-[#A1A09A]">
                                        Monitor expenses, track revenue, and maintain detailed financial records.
                                    </p>
                                </div>
                            </div>

                            <!-- Feature 4 -->
                            <div class="relative feature-card p-6 rounded-lg bg-white dark:bg-[#0a0a0a] shadow-sm hover:shadow-md transition-all">
                                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#1b1b18]">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <div class="ml-16">
                                    <h3 class="text-lg leading-6 font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Smart Analytics</h3>
                                    <p class="mt-2 text-base text-[#706f6c] dark:text-[#A1A09A]">
                                        Get insights and analytics to optimize your farm operations and increase productivity.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-white dark:bg-[#0a0a0a] border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <p class="text-base text-[#706f6c] dark:text-[#A1A09A]">
                            &copy; {{ date('Y') }} CropWise. All rights reserved.
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
