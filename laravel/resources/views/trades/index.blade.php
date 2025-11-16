@extends('layouts.layout')

@section ('slot')
    <div class="py-4 px-4 text-black font-semibold text-lg">
        <p class="font-semibold text-black p-2 rounded bg-[#C9A14D] w-fit" >Anúncios</p>
    </div>
    <div class="flex flex-wrap justify-center gap-5 m-2 text-white font-semibold">
        @foreach ($trades as $trade)
            <div class="bg-[#4A78C26c] rounded-lg shadow-[0_4px_8px_black] overflow-hidden flex flex-col justify-around
                w-full p-4 sm:w-[300px] md:w-[350px] lg:w-[400px]">
                <a href="{{ route('showTrade', $trade->id)}}" class="flex flex-col">
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
    <div class="mt-4 place-self-center">{{ $trades->links() }}</div>
    <div class="mt-4 place-self-center">
        <a href="{{ route('home')}}" class="rounded w-fit bg-[#C9A14D] p-2 font-semibold">Voltar</a>
    </div>
@endsection