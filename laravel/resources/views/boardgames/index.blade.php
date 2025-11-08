@extends('layouts.layout')

@section ('slot')
    <div class="py-4 px-4 text-black font-semibold text-lg">
        <p class="font-semibold text-black p-2 rounded bg-[#C9A14D] w-fit" >Boardgames</p>
    </div>
    <div class="flex flex-wrap justify-center gap-5 m-2 text-white font-semibold">
        @foreach ($boardgames as $boardgame)
            <div class="bg-[#4A78C26c] rounded-lg shadow-[0_4px_8px_black] overflow-hidden flex flex-col items-center justify-center
                w-full p-4 sm:w-[300px] md:w-[350px] lg:w-[400px]">
                <a href="{{ route('showBoardgame', $boardgame->id)}}" class="flex flex-col">
                    <img src="/assets/capateste1.jpg" alt="capa" class="w-[100px] h-auto object-contain self-center">
                    <p class="self-center">{{ $boardgame->title }}</p>
                    <p>Jogadores: {{ $boardgame->players }}</p>
                    <p>Tempo de Jogo {{ $boardgame->playtime }}</p>
                </a>
            </div>
        @endforeach
    </div> 
    <div class="mt-4 place-self-center">{{ $boardgames->links() }}</div>
    <div class="mt-4 place-self-center">
        <a href="{{ route('home')}}" class="rounded w-fit bg-[#C9A14D] p-2 font-semibold">Voltar</a>
    </div>

@endsection