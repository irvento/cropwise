<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&display=swap');
        .cartoony-font {
            font-family: 'Comic Neue', cursive;
        }
    </style>

    <x-authentication-card class="cartoony-font">
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" class="text-lg" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <x-input id="email" class="block mt-1 w-full pl-12 py-3 border-2 border-indigo-200 rounded-xl" 
                             type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                             placeholder="your@email.com" />
                </div>
            </div>

            <div class="mt-6">
                <x-label for="password" value="{{ __('Password') }}" class="text-lg" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <x-input id="password" class="block mt-1 w-full pl-12 py-3 border-2 border-indigo-200 rounded-xl" 
                             type="password" name="password" required autocomplete="current-password" 
                             placeholder="••••••••" />
                </div>
            </div>

            <div class="flex justify-between items-center mt-6 flex-wrap gap-2">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" class="h-5 w-5 text-indigo-600" />
                    <span class="ms-2 text-lg text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-400">
                        Register
                    </a>
                </p>
            </div>

            <div class="flex items-center justify-end mt-6">
                @if (Route::has('password.request'))
                    <a class="underline text-lg text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 rounded-md" 
                       href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4 bg-yellow-500 hover:bg-yellow-600 text-lg py-3 px-6 rounded-xl border-black border shadow-xs
">
                    {{ __('Log in') }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                </x-button>
            </div>
        </form>
       
    </x-authentication-card>
</x-guest-layout>