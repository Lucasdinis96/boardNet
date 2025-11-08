@php
    $previous = url()->previous();
@endphp

@extends ('layouts.layout')

@section('slot')
<div class="flex flex-col">
    <div class="bg-[#4A78C26c] rounded-lg shadow-[0_4px_8px_black] overflow-hidden flex flex-row justify-around
                    p-4 m-4 text-white gap-5">    
        <div class="w-auto h-auto flex flex-col items-center justify-center">
            <img src="/assets/capateste2.webp" alt="capa" class="max-w-full h-auto object-contain"><br/>
            @auth  
                @php
                    $hasGame = auth()->user()->boardgames()
                        ->where('boardgame_id', $boardgame->id)->first();    
                @endphp
                @if($hasGame)
                    <form action="{{ route('removeCollection', $hasGame->pivot->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="rounded bg-red-600 text-white hover:bg-red-700 p-2">Remover da Coleção</button>
                    </form>
                @else
                    <form action="{{ route('addCollection')}}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->id()}}">
                        <input type="hidden" name="boardgame_id" value="{{ $boardgame->id }}">
                        <button class="rounded bg-[#C9A14D] hover:bg-[#d3b370] text-black p-2">Adicionar a Coleção</button>
                    </form>
                @endif
            @else
                    <button onclick="alert('Crie sua conta para adicionar a coleção')" class="rounded bg-[#C9A14D] text-black p-2">
                        Adicionar a coleção
                    </button>
            @endauth
        </div>
        <div class="text-justify w-auto h-auto">
            <p><strong>Titúlo:</strong> {{ $boardgame->title }}</p><br/>
            <p><strong>Editora:</strong> {{ $boardgame->publisher }}</p><br/>
            <p><strong>Jogadores:</strong> {{ $boardgame->players }}</p><br/>
            <p><strong>Tempo de Jogo:</strong> {{ $boardgame->playtime }}</p><br/>
            <p><strong>Faixa etária:</strong> {{ $boardgame->age_range}}</p><br/>
            <p><strong>Descrição:</strong> <br/> {{ $boardgame->description }}</p>
        </div>
    </div class="flex items-center justify-center">
        <a href="{{ $previous ? $previous : route('home') }}" class="rounded w-fit bg-[#C9A14D] hover:bg-[#d3b370] p-2 font-semibold">Voltar</a>
    </div>
</div>
@endsection