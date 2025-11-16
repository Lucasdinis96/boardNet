@php
    $previous = url()->previous();
@endphp

@extends('layouts.layout')

@section ('slot')
<div class="flex flex-col justify-center items-center">
    <div class="bg-[#4A78C26c] rounded-lg shadow-[0_4px_8px_black] overflow-hidden flex flex-row justify-around
                    p-4 m-4 text-white gap-5">
        <div class="text-justify w-full h-full">
                <p><strong>Titúlo:</strong> {{ $trade->title }}</p><br/>
                <p><strong>Descrição: </strong> {{ $trade->description }}</p><br/>
                <p><strong>Vendedor: </strong> {{ $trade->user->name }}</p><br/>
                <p><strong>Jogos:</strong></p>
                    <ul>
                        @foreach ($trade->boardgames as $game)
                            <li> - {{ $game->title }} Valor: R$ {{ $game->pivot->value }}</li>
                        @endforeach
                    </ul>
                <br/>
                <p><strong>Cidade: </strong> {{ $trade->user->city->name }}-{{ $trade->user->city->state->uf }}</p><br/>
                <div class="flex flex-row justify-center items-center">
                    <a href="https://wa.me/{{ $trade->user->phone }}" target="_blank" class="text-black hover:underline rounded bg-green-500 p-2">
                        Entrar em Contato
                    </a>
                </div>
        </div>
    </div>
    
    <div>
        <a href="{{ $previous ? $previous : route('home') }}" class="rounded w-fit bg-[#C9A14D] hover:bg-[#d3b370] p-2 font-semibold">Voltar</a>
    </div>
</div>
@endsection