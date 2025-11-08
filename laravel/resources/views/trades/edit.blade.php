<script>
    const BOARDGAMES = @json($boardgames->map(function($b) {
        return ['id' => $b->id, 'title' => $b->title];
    }));
</script>

@extends('layouts.layout')
@section('slot')

<div class="flex flex-col justify-center items-center">
    <div class="bg-[#4A78C26c] rounded-lg shadow-[0_4px_8px_black] overflow-hidden flex flex-col md:flex-row justify-around p-4 m-4 text-black gap-5 w-[700px]"> 
        <div class="flex-1 flex-col">
            <h1 class="text-2xl font-semibold text-white mb-6">
                Editar Anúncio
            </h1>
            <form action="{{ route('updateTrade', $trade->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" class="block font-semibold text-white" ">
                        Título
                    </label>
                    <input type="text" name="title" id="title" class="form-input mt-1 block w-full" value="{{ old('title', $trade->title) }}" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block font-semibold text-white">
                        Descrição
                    </label>
                    <textarea type="text" name="description" id="description" class="form-input mt-1 block w-full" rows="5">{{ old('description', $trade->description) }}</textarea>
                </div>
                <p class="text-white font-semibold">Jogos a venda:</p>
                <div class="flex-1">
                    <div id="boardgames-wrapper">
                        @foreach ($trade->boardgames as $game)    
                            <div class="boardgame-row flex gap-2 mb-2">
                                <select name="boardgames[{{ $loop->index }}][id]" class="border p-2 pr-8 rounded w-[400px]">
                                    @foreach ($boardgames as $boardgame)
                                        <option value="{{ $boardgame->id }}" {{ $boardgame->id == $game->id ? 'selected' : ''}}>{{ $boardgame->title }}</option>
                                    @endforeach
                                </select>
                                <input type="number" name="boardgames[{{ $loop->index }}][value]" placeholder="Valor" class="border p-2 rounded" step="0.01" value="{{ $game->pivot->value }}"/>
                                <a href="#" class="removeGame bg-red-600 text-white px-2 rounded" data-trade="{{ $trade->id }}" data-game="{{ $game->id }}">
                                    X
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-boardgame" class="bg-green-500 text-white px-4 py-2 rounded my-2">
                        + Adicionar jogo
                    </button>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Salvar
                </button>
            </form>
            <div>
                <form action="{{ route('deleteTrade', $trade->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este anúncio?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Excluir Anúncio</button>
                </form>
            </div>
        </div>
    </div>
    <div>
        <a href="{{ route('myTrades') }}" class="rounded w-fit bg-[#C9A14D] hover:bg-[#d3b370] p-2 font-semibold place-self-center">Voltar</a>
    </div>
</div>

<script>
    let index = {{ $trade->boardgames->count() }};

    function optionsHtml() {
        return BOARDGAMES.map(b => `<option value="${b.id}">${b.title}</option>`).join('');
    }
    
    document.getElementById('add-boardgame').addEventListener('click', function () {
        const wrapper = document.getElementById('boardgames-wrapper');

        const html = `
        <div class="boardgame-row flex gap-2 mb-2">
            <select name="boardgames[${index}][id]" class="border p-2 rounded w-[400px]">
                <option value="">Selecione um jogo</option>
                ${optionsHtml()}
            </select>
            <input type="number" name="boardgames[${index}][value]" min="0" placeholder="Valor" class="border p-2 rounded" step="0.01" />
            <button type="button" class="removeGame bg-red-600 text-white px-2 rounded">X</button>
        </div>
        `;

        wrapper.insertAdjacentHTML('beforeend', html);
        index++;
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('removeGame')) {
            e.target.closest('.boardgame-row').remove();
        }
    });
</script>

@endsection