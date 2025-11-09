@extends('layouts.layout')
@section ('slot')
<div class="mt-8 px-6 py-4 bg-[#4A78C26c] shadow-md overflow-hidden sm:rounded-lg place-self-center font-semibold">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirme sua Senha')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="birthdate" :value="__('Data de Nascimento')" />
            <x-text-input id="birthdate" name="birthdate" type="date" class="mt-1 block w-full" required autofocus autocomplete="birthdate" />
            <x-input-error class="mt-2" :messages="$errors->get('birthdate')" />
        </div>

       <div class="mt-4">
            <x-input-label for="city" :value="__('Cidade')" />
            <x-text-input 
                type="text" 
                id="city-input" 
                name="city_name" 
                class="mt-1 block w-[470px] border-gray-300 rounded-md shadow-sm" 
                placeholder="Digite o nome da cidade..." 
                autocomplete="off"
                value=""
            />
            <input type="hidden" name="city_id" id="city-id" value="">
            <div 
                <x-text-input id="city-results" 
                class="absolute z-10 w-[470px] border border-gray-300 rounded-md mt-1 hidden max-h-48 overflow-y-auto"
            />
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
        </div>

        <div class="mt-4">
            <x-input-label for="phone" :value="__('Telefone')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" required autofocus autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-white font-semibold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Já possui Conta?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registre-se') }}
            </x-primary-button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('city-input');
    const results = document.getElementById('city-results');
    const cityId = document.getElementById('city-id');
    let timeout = null;

    input.addEventListener('input', () => {
        clearTimeout(timeout);
        const query = input.value.trim();

        if (query.length < 2) {
            results.innerHTML = '';
            results.classList.add('hidden');
            return;
        }

        // atraso para evitar chamadas excessivas
        timeout = setTimeout(() => {
            fetch(`/cities/search?q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    results.innerHTML = '';
                    if (data.length === 0) {
                        results.innerHTML = '<div class="p-2 text-gray-500">Nenhuma cidade encontrada</div>';
                    } else {
                        data.forEach(city => {
                            const option = document.createElement('div');
                            option.textContent = city.name; // "São Paulo - SP"
                            option.classList.add('p-2', 'cursor-pointer', 'hover:bg-white', 'hover:text-black');
                            option.addEventListener('click', () => {
                                input.value = city.name;
                                cityId.value = city.id;
                                results.innerHTML = '';
                                results.classList.add('hidden');
                            });
                            results.appendChild(option);
                        });
                    }
                    results.classList.remove('hidden');
                });
        }, 300);
    });

    // Fecha o dropdown ao clicar fora
    document.addEventListener('click', (e) => {
        if (!results.contains(e.target) && e.target !== input) {
            results.classList.add('hidden');
        }
    });
});
</script>


@endsection
