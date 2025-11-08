@extends('layouts.layout')
@section('slot')
<div class="w-full sm:max-w-md mt-48 px-6 py-4 bg-[#4A78C26c] shadow-md overflow-hidden sm:rounded-lg place-self-center font-semibold text-white">
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Obrigado por se registrar! Antes de começar, verifique seu email clicando no link que foi enviado. Se não tiver recebido o email, podemos enviar outro.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('Um novo link de verificação foi enviado ao email cadastrado.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Enviar Verficação Novamente') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Sair') }}
            </button>
        </form>
    </div>
</div>
@endsection
