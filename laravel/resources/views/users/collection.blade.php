@extends('layouts.layout')
@section('slot')
@if ($boardgames->isEmpty())
    <div class="bg-[#4A78C26c] rounded-lg shadow-[0_4px_8px_black] overflow-hidden flex flex-row justify-around
                    p-4 m-4 text-white">
        <p>Você ainda não adicionou nenhum jogo à coleção.</p>
    </div>
@else
    <div class="flex flex-wrap justify-center gap-5 mt-8 text-white font-semibold">
        @foreach ($boardgames as $boardgame)
            <div class="bg-[#4A78C26c] rounded-lg shadow-[0_4px_8px_black] overflow-hidden flex flex-col items-center justify-center
                w-full p-4 sm:w-[300px] md:w-[350px] lg:w-[400px]">
                <a href="{{ route('showBoardgame', $boardgame->id) }}" class="flex flex-col">
                    <img src="{{ asset($boardgame->cover) }}"" alt="capa" class="w-[100px] h-auto object-contain self-center">
                    <p class="self-center">{{ $boardgame->title }}</p>
                    <p>Jogadores: {{ $boardgame->players }}</p>
                    <p>Tempo de Jogo {{ $boardgame->playtime }}</p>
                </a>
                <form action="{{ route('removeCollection', $boardgame->id) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button class="rounded bg-red-600 text-white hover:bg-red-700 p-2">Remover da Coleção</button>
                </form>
            </div>
        </a>
                    
        @endforeach
    </div> 
    <div class="mt-4 place-self-center">{{ $boardgames->links() }}</div>
@endif
@endsection