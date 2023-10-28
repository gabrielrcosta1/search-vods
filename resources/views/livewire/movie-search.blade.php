<div class="sm:col-span-2">
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Pesquisar
        Filme</label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>
        <input type="search" id="default-search" wire:model.defer="searchQuery"
            class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Filmes..." required>
        <x-button
            class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            wire:click="searchMovies" loading>
            Pesquisar Filme
        </x-button>

    </div>
    <br>
    <hr>
    <br>
    @if (!empty($movies))
        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Escolha uma
            opção</label>
        <select id="countries" wire:model='selectedMovie' wire:change="searchMoviesByID"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Selecione um filme</option>
            @foreach ($movies as $movie)
                <option value="{{ $movie['id'] }}">{{ $movie['stream_display_name'] }}</option>
            @endforeach
        </select>
    @endif
    <br>
    @if ($selectedMovie)
        <div>
            <div class="px-4 sm:px-0">
                <h3 class="text-base font-semibold leading-7 text-gray-900">Informações do Filme</h3>
            </div>
            <div class="mt-6 border-t border-gray-100">
                <dl class="divide-y divide-gray-100">
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Nome do Filme</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $streamName }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Ano de Lançamento</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $year }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Categoria</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $category }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Sinopse</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $streamDescription }}
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Imagem</dt>
                        <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            <figure class="max-w-lg">
                                @if ($findMoviesPropries === true)
                                    <img class="h-auto max-w-full rounded-lg"
                                        src="https://image.tmdb.org/t/p/w600_and_h900_bestv2/{{ $streamImage }}"
                                        alt="image description">
                                    <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Image
                                        caption
                                    </figcaption>
                                @else
                                    <img class="h-auto max-w-full rounded-lg"
                                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png"
                                        alt="image description">
                                    <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Image
                                        caption
                                    </figcaption>
                                @endif
                            </figure>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    @endif



</div>
