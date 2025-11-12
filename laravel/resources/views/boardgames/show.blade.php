@extends ('layouts.layout')

@section('slot')
<div class="flex flex-col items-center">
    <div class="bg-[#4A78C26c] rounded-lg shadow-[0_4px_8px_black] overflow-hidden flex flex-row justify-around
                    p-4 m-4 text-white gap-5">    
        <div class="w-auto h-auto flex flex-col items-center justify-center">
            <img src="{{ asset($boardgame->cover) }}" alt="capa" class="max-w-full h-auto object-contain"><br/>
            <div id="collection-section">
                @php
                    $inCollection = auth()->check() && auth()->user()->boardgames->contains($boardgame->id);
                @endphp
                @auth
                    <button id="toggleCollectionBtn"
                            data-boardgame-id="{{ $boardgame->id }}"
                            data-action="{{ $inCollection ? 'remove' : 'add' }}"
                            class="{{ $inCollection ? 'bg-red-600' : 'bg-green-600' }} text-white px-4 py-2 rounded">
                        {{ $inCollection ? 'Remover da Coleção' : 'Adicionar à Coleção' }}
                    </button>
                @endauth
            </div>
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
        <a href="{{ $goBack }}" class="rounded w-fit bg-[#C9A14D] hover:bg-[#d3b370] p-2 ml-4 font-semibold">Voltar</a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('toggleCollectionBtn');
    if (!btn) return;

    btn.addEventListener('click', async () => {
        const boardgameId = btn.dataset.boardgameId;
        const action = btn.dataset.action;
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const url = action === 'add'
            ? "{{ route('addCollection') }}"
            : "{{ route('removeCollection', $boardgame->id) }}";

        const method = action === 'add' ? 'POST' : 'DELETE';

        btn.disabled = true;
        btn.textContent = action === 'add' ? 'Adicionando...' : 'Removendo...';

        try {
            const response = await fetch(url, {
                method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: action === 'add' ? JSON.stringify({ boardgame_id: boardgameId }) : null,
            });

            // se Laravel retornou uma página HTML (ex: redirect), cancela
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                console.warn('Resposta não é JSON — pode ser redirect. Recarregando...');
                window.location.reload();
                return;
            }

            const data = await response.json();

            if (data.status === 'added') {
                btn.dataset.action = 'remove';
                btn.textContent = 'Remover da Coleção';
                btn.classList.remove('bg-green-600');
                btn.classList.add('bg-red-600');
            } else if (data.status === 'removed') {
                btn.dataset.action = 'add';
                btn.textContent = 'Adicionar à Coleção';
                btn.classList.remove('bg-red-600');
                btn.classList.add('bg-green-600');
            }
        } catch (err) {
            console.error('Erro ao atualizar coleção:', err);
            btn.textContent = 'Erro!';
        } finally {
            btn.disabled = false;
        }
    });
});
</script>

@endsection