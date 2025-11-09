@extends('layouts.layout')

@section('slot')
    <div class="py-4 px-4 text-white font-semibold flex flex-col">
        <p class="self-center text-center text-[30px]">
            Seu portal de troca e venda de jogos de tabuleiro.<br/>
            Encontre hoje sua nova aventura.
        </p>
        <a href="{{ auth()->check() ? route('myTrades') : route('register') }}" class="w-fit self-center text-[20px] text-black p-2 mt-2 rounded bg-[#C9A14D] hover:bg-[#d3b370]">
            {{ auth()->check() ? 'Ir para o Perfil' : 'Crie Sua Conta!' }}
        </a>
    </div>
     <div class="py-2 px-4 text-black font-semibold text-lg">
        <a href="{{ route('trades') }}" class="font-semibold text-black p-2 rounded bg-[#C9A14D] w-fit hover:bg-[#d3b370]" >Anúncios Recentes</a>
    </div>
     <div class="flex flex-wrap justify-center gap-5 m-2 text-white font-semibold">
        @foreach ($trades as $trade)
        <div class="bg-[#4A78C26c] rounded-lg shadow-[0_4px_8px_black] overflow-hidden flex flex-col justify-around
            w-full p-4 sm:w-[300px] md:w-[350px] lg:w-[400px]">
            <a href="{{ route('showTrade', $trade->id) }}" class="flex flex-col">
                <p class="self-center">{{ $trade->title }}</p>
                <p>Jogos a venda:</p>
                <ul>
                    @foreach ($trade->boardgames as $game)
                        <li> - {{ $game->title }} Valor: R$ {{ $game->pivot->value }}</li>
                    @endforeach
                </ul>
                <p>Vendedor: {{ $trade->user->name }}</p>
                <p>Cidade: {{ $trade->user->city->name }}</p>
            </a>
        </div>
        @endforeach
    </div>
    <div class="py-4 px-4 text-black font-semibold text-lg">
        <a href="{{ route('boardgames') }}" class="w-fit font-semibold text-black p-2 rounded bg-[#C9A14D] hover:bg-[#d3b370]" >Novidades</a>
    </div>
    <div class="flex flex-wrap justify-center gap-5 m-2 text-white font-semibold">
        @foreach ($boardgames as $boardgame)
            <div class="bg-[#4A78C26c] rounded-lg shadow-[0_4px_8px_black] overflow-hidden flex flex-col items-center justify-center
                w-full p-4 sm:w-[300px] md:w-[350px] lg:w-[400px]">
                <a href="/boardgame/{{ $boardgame->id }}" class="flex flex-col">
                    <img src="{{ asset($boardgame->cover) }}" alt="capa" class="w-[100px] h-auto object-contain self-center">
                    <p class="self-center">{{ $boardgame->title }}</p>
                    <p>Jogadores: {{ $boardgame->players }}</p>
                    <p>Tempo de Jogo {{ $boardgame->playtime }}</p>
                </a>
            </div>
        @endforeach
    </div>    
    
@endsection