<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ver pelicula: {{ $pelicula->ficha->titulo }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 bg-black">
                    <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                        <div class="flex flex-col py-3">
                            <dt class="mb-1 text-white md:text-lg dark:text-gray-400">
                                Titulo
                            </dt>
                            <dd class="text-lg text-white font-semibold">
                                {{ $pelicula->ficha->titulo }}
                            </dd>
                        </div>
                        <div class="flex flex-col py-3">
                            <dt class="mb-1 text-white md:text-lg">
                                Autor
                            </dt>
                            <dd class="text-lg text-white font-semibold">
                                {{ $pelicula->director }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
            <div class="mt-6 text-center">
                <a href="{{ route('peliculas.index') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-2xl text-sm px-20 py-4 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Volver
                </a>
            </div>
            <h2 class="mt-5 font-semibold text-xl text-gray-800 leading-tight">
                Comentarios:
            </h2>

            @foreach ($pelicula->ficha->comentarios as $comentario)
                <div
                    class="mt-4 max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $comentario->user->name }}
                        </h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        {{ $comentario->texto }}
                    </p>
                    @can('delete-comentario', $comentario)
                        <form action="{{ route('comentarios.destroy', $comentario) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                Eliminar
                            </button>
                        </form>
                    @endcan
                </div>
            @endforeach
        </div>
    </div>
    <div class="p-10 mt-6 text-center">
        <form method="POST" action="{{ route('comentario.crear', $pelicula->ficha) }}" class="max-w-sm mx-auto">
            @csrf
            <div class="mb-5">
                <textarea id="texto" name="texto" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300
                          focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                          dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Comentario..."></textarea>
                <x-input-error :messages="$errors->get('texto')" class="mt-2" />
            </div>
            <button type="submit" style="background-color: black; color: white;">
                Crear
            </button>
        </form>
    </div>
</x-app-layout>
