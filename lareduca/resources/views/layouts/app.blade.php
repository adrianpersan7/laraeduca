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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased">

<!-- Banner -->
<x-banner />

<div class="sticky left-0 top-0 min-h-screen flex" style="background-color: #2C7D69;">
   
    <div class="w-64 text-white shadow-2xl" style="background-color: #0F5E4B;">
        <div class="flex items-center justify-center h-16" style="background-color: #053E30;">
            <span class="text-lg font-bold">Sidebar</span>
        </div>
        <div class="min-h-screen flex" style="background-color: #316F60;">
       <div class="hidden sm:-my-px sm:ms-10 sm:flex flex-col">
            <div class="transition duration-300 ease-in-out transform hover:translate-x-2 mt-10">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('                     ') }}
                </x-nav-link>
                
            </div>
            <div class="transition duration-300 ease-in-out transform hover:translate-x-2 mt-4">
                <x-nav-link href="{{ route('users') }}" :active="request()->routeIs('users')">
                    {{ __('Users') }}
                </x-nav-link>
                <div class="border-b border-gray-300 w-full"></div>
            </div>
            <div class="transition duration-300 ease-in-out transform hover:translate-x-2 mt-4">
                <x-nav-link href="{{ route('courses') }}" :active="request()->routeIs('courses')">
                    {{ __('Courses') }}
                </x-nav-link>
                <div class="border-b border-gray-300"></div>
            </div>
            <div class="transition duration-300 ease-in-out transform hover:translate-x-2 mt-4">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Home') }}
                </x-nav-link>
                <div class="border-b border-gray-300"></div>
            </div>
        </div>
    </div>
</div>


    <div class="flex-1">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="shadow" style="background-color: #053E30;">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

              

        <!-- Page Content -->
        <main class="p-6">
            {{ $slot }}
        </main>
    </div>
</div>

@stack('modals')

@livewireScripts
</body>
</html>