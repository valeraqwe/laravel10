<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $metaTitle ?: 'Комар Н.М. - персональний сайт' }}</title>
    <meta name="google-site-verification" content="QFEHOTv6xljhM1Wix1aTcWyZe8RpvylE9cYu1O8XLHw" />
    <meta name="author" content="Комар Н.М.">
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:image" content="{{ url('images/ukraine-flag.jpg') }}">
    <link rel="icon"
          href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>
          ✏️</text></svg>">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lobster+Two:ital,wght@1,400;1,700&display=swap');
    </style>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
            integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>

    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-200 font-family-lobster">


<!-- Text Header -->
<header class="w-full container mx-auto">
    <div class="flex flex-col items-center justify-center py-12">
        <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl text-center" href="{{route('home')}}">
            Сайт<br>Комар Наталії<br>Миколаївни
        </a>
        <p class="text-lg text-gray-600 text-center">
            {{ \App\Models\TextWidget::getTitle('header') }}
        </p>
    </div>
</header>


<nav class="w-full bg-gray-300 items-center py-6 border-t border-b bg-gray-100" x-data="{ open: false }">
    <div class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-4">
        <div class="my-2 flex items-center justify-center">
            <a href="{{ route('home') }}" class="nav-link rounded py-3 px-4 mx-4">Головна</a>

            <div class="relative sm:hidden">
                <button @click="open = !open" class="nav-link rounded py-2">
                    Категорії<i :class="open ? 'fa-chevron-up': 'fa-chevron-down'" class="fas ml-2"></i>
                </button>
                <div x-show="open" @click.away="open = false" class="absolute z-10 w-40 bg-white rounded shadow-lg mt-2">
                    @foreach($categories as $category)
                        <a href="{{ route('by-category', $category) }}" class="nav-link block px-4 py-2 text-gray-800 hover:bg-gray-200">{{ $category->title }}</a>
                    @endforeach
                </div>
            </div>

            <div class="hidden sm:flex">
                @foreach($categories as $category)
                    <a href="{{ route('by-category', $category) }}" class="nav-link rounded py-3 px-4 mx-4">{{ $category->title }}</a>
                @endforeach
            </div>

            <a href="{{ route('about-author') }}" class="nav-link rounded py-3 px-4 mx-4">Автор</a>
        </div>
    </div>
</nav>


<!-- Site Content -->
<div class="container mx-auto py-6">
    <!-- Search, Login, and Register -->
    <div class="flex items-center justify-center sm:justify-end mt-4 sm:mt-0">
        <form method="get" action="{{ route('search') }}">
            <input name="q" value="{{ request()->get('q') }}"
                   class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 font-medium"
                   placeholder="🔍 Тисни для пошуку..."/>
        </form>
    @auth
            <div class="flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="hover:bg-blue-600 hover:text-white flex items-center rounded py-3 px-4 mx-2">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                     this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        @else
            <div class="flex items-center mt-4 sm:mt-0">
                <a href="{{ route('login') }}"
                   class="hover:bg-blue-600 hover:text-white rounded py-1 px-2 sm:px-4 mx-2 transition duration-300 ease-in-out transform hover:scale-105">Увійти</a>
                <a href="{{ route('register') }}"
                   class="bg-blue-600 text-white rounded py-1 px-2 sm:px-4 mx-2 transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-md">Реєстрація</a>
            </div>
        @endauth
    </div>

    <!-- Site Content -->
    {{ $slot }}
</div>


<footer class="w-full border-t bg-gray-300 pb-12">
    <div class="w-full container mx-auto flex flex-col items-center">
        <div class="uppercase py-6">&copy; komar-nm.net.ua 2023</div>
        <p>Made with 💚 by <a class="hover:bg-gray-500/10" href="https://github.com/valeraqwe"> Valeriy Komar</a>
        </p>
    </div>
</footer>

@livewireScripts
</body>
</html>
