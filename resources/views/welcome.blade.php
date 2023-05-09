<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
<div
        class="relative flex flex-col sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{__('Dashboard')}}</a>
            @endauth
        </div>
    @endif

    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="flex justify-center">
            <x-application-logo :size="200"/>
        </div>
        <div class="mt-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex">
                    <div class="text-center">
                        <h2 class="mt-6 text-2xl font-semibold text-gray-900 dark:text-white">
                            {{__('Welcome to Coffee Break!')}}
                        </h2>
                        <p class="mt-8 text-gray-500 dark:text-gray-100  text-lg leading-relaxed">
                            {{__('Indulge in instant gratification with our state-of-the-art vending machine system.')}}
                        </p>
                        <p class="mt-8 text-gray-500 dark:text-gray-100 text-base text-center leading-relaxed">
                            {{__('From snacks to beverages and everything in between, satisfy your cravings on the go.')}}
                            {{__('Experience convenience like never before with our reliable and diverse selection of products.')}}
                        </p>
                    </div>
                </div>

                <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex">
                    <div class="grid md:grid-cols-2 gap-10 w-full">
                        <div class="flex flex-col align-content-center justify-center">
                            <p class="text-gray-600 dark:text-gray-100 text-center">
                                {{ __('Still don\'t have an account?' )}}
                                <br/>
                                {{__('Please ')}}<a class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                                    href="{{route('register')}}">{{__('consider register')}}</a>
                            </p>
                        </div>
                        <div>
                            @include('auth.login-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
            <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">
                <div class="flex items-center gap-4">
                    Made with &#10084; and Laravel v{{ Illuminate\Foundation\Application::VERSION }}
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
