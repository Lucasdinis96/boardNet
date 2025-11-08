@extends('layouts.layout')
@section('slot')
<div class="w-full sm:max-w-md mt-48 px-6 py-4 bg-[#4A78C26c] shadow-md overflow-hidden sm:rounded-lg place-self-center font-semibold text-white">
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Está é uma área segura do sistema. Coloque sua senha para continuar') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Senha')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirmar') }}
            </x-primary-button>
        </div>
    </form>
</div>
@endsection
