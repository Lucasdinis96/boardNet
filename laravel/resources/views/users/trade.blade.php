@extends('layouts.layout')

@section ('slot')
    <div class="py-4 px-4 text-black font-semibold text-lg">
        <a href="{{ route('createTrade') }}" class="font-semibold text-black p-2 rounded bg-[#C9A14D] w-fit" >Criar Anúncio</a>
    </div>
    @if ($trades->isEmpty())
        <div class="bg-[#4A78C26c] rounded-lg shadow-[0_4px_8px_black] overflow-hidden flex flex-row justify-around
                        p-4 m-4 text-white">
            <p>Você ainda não criou nenhum anúncio.</p>
        </div>
    @else
    <div class="flex flex-wrap justify-center gap-5 m-2 text-white font-semibold">
        @foreach ($trades as $trade)
            <div class="bg-[#4A78C26c] rounded-lg shadow-[0_4px_8px_black] overflow-hidden flex flex-col justify-around
                w-full p-4 sm:w-[300px] md:w-[350px] lg:w-[400px]">
                <a href="{{ route('editTrade', $trade->id) }}" class="flex flex-col">
                    <p class="self-center">{{ $trade->title }}</p>
                    <p>Jogos:</p>
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
    @endif
@endsection