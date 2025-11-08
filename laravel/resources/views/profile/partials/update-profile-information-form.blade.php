<section>
    <header>
        <h2 class="text-lg font-medium text-white font-semibold">
            {{ __('Informações do Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-white">
            {{ __("Atualize os dados do seu perfil e seu email.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="birthdate" :value="__('Data de Nascimento')" />
            <x-text-input id="birthdate" name="birthdate" type="date" class="mt-1 block w-full" :value="old('birthdate', $user->birthdate)" required autofocus autocomplete="birthdate" />
            <x-input-error class="mt-2" :messages="$errors->get('birthdate')" />
        </div>

        <div>
            <x-input-label for="city" :value="__('Cidade')" />
            <x-text-input 
                type="text" 
                id="city-input" 
                name="city_name" 
                class="mt-1 block w-[470px] border-gray-300 rounded-md shadow-sm" 
                placeholder="Digite o nome da cidade..." 
                autocomplete="off"
                value="{{ old('city_name', $user->city ? $user->city->name . ' - ' . $user->city->state->uf : '') }}"
            />
            <input type="hidden" name="city_id" id="city-id" value="{{ old('city_id', $user->city_id) }}"/>
            <div
                <x-text-input id="city-results" 
                class="absolute z-10 w-[470px] border border-gray-300 rounded-md mt-1 hidden max-h-48 overflow-y-auto"
                />
            />
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
        </div>

        <div class="flex items-center gap-4 mt-2">
            <x-primary-button>{{ __('Salvar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-white"
                >{{ __('Salvo.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('city-input');
    const results = document.getElementById('city-results');
    const cityId = document.getElementById('city-id');
    let timeout = null;

    input.addEventListener('input', () => {
        clearTimeout(timeout);
        const query = input.value.trim();

        if (query.length < 2) {
            results.innerHTML = '';
            results.classList.add('hidden');
            return;
        }

        // atraso para evitar chamadas excessivas
        timeout = setTimeout(() => {
            fetch(`/cities/search?q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    results.innerHTML = '';
                    if (data.length === 0) {
                        results.innerHTML = '<div class="p-2 text-gray-500">Nenhuma cidade encontrada</div>';
                    } else {
                        data.forEach(city => {
                            const option = document.createElement('div');
                            option.textContent = city.name;
                            option.classList.add('p-2', 'cursor-pointer', 'hover:bg-white', 'hover:text-black');
                            option.addEventListener('click', () => {
                                input.value = city.name;
                                cityId.value = city.id;
                                results.innerHTML = '';
                                results.classList.add('hidden');
                            });
                            results.appendChild(option);
                        });
                    }
                    results.classList.remove('hidden');
                });
        }, 300);
    });

    // Fecha o dropdown ao clicar fora
    document.addEventListener('click', (e) => {
        if (!results.contains(e.target) && e.target !== input) {
            results.classList.add('hidden');
        }
    });
});
</script>
