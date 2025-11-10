<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>BoardNet</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="shortcut icon" type="imagex/png" href="{{ asset('assets/icon.png') }}"

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-screen flex flex-col">
        <header>
            <div class="fixed top-0 left-0 w-full z-50 py-6 px-4 sm:px-6 lg:px-8 flex items-center justify-between bg-black">
                <div class="self-center flex-1 flex justify-center sm:pl-[120px] px-2 py-2 text-4xl font-semibold text-[#C9A14D]">
                    <a href="{{ route('home') }}" class="flex flex-row gap-3">
                        <img src="{{ asset('assets/icon.png') }}" alt="icon" class="size-[40px]">
                        BoardNet
                    </a>
                </div>
                @auth
                <div class="justify-self-end px-4 py-2 flex items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button " class="font-semibold text-black p-2 rounded bg-[#C9A14D] w-fit">
                                {{ Auth::user()->name }}
                            </button>
                         </x-slot>
                         <x-slot name="content">
                            <x-dropdown-link :href="route('myTrades')">
                                Perfil
                            </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Sair') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                </div>
                @else
                <div class="justify-self-end px-4 py-2 flex items-center">
                    <a href="{{ route('login') }}" class="font-semibold text-black p-2 rounded bg-[#C9A14D] w-fit">
                        Entre
                    </a>
                </div>
            </div>
            
            @endauth
            
        </header>
        <main class="pt-24 flex-grow relative">
            <div class="fixed top-0 left-0 w-full h-screen bg-cover bg-center -z-10" 
                    style="background-image: url('{{ asset('assets/background.png')}}')">
            </div>
            @if (Route::is('myCollection') || Route::is('editProfile') || Route::is('myTrades'))
                <div class="p-6 w-full h-auto bg-[#4A78C26c] flex flex-row place-content-center gap-5 text-white font-semibold">
                <a href="{{ route('myTrades')}}">Meus Anúncios</a>
                <a href="{{ route('myCollection') }}">Minha Coleção</a>
                <a href="{{ route('editProfile') }}">Meus Dados</a>
                </div>
            @endif
            @yield('slot')
        </main>
        <footer>
            <div class="bg-black text-white text-center py-4 mt-3">
                <p> &copy {{ date('Y') }} BoardNet - Todos os Direitos reservados. </p>
            </div>
        </footer>
    </body>
</html>