
<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        titulo
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        director
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        duracion
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Ncomentarios
                                    </th>
                                    <th colspan="3" scope="col" class="px-6 py-3">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peliculas as $pelicula)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $pelicula->ficha->titulo}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $pelicula->director }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $pelicula->duracion }}
                                    </td>
                                    @php

                                        $contador = $pelicula->ficha->comentarios->count();
                                    @endphp
                                    <td class="px-6 py-4">
                                        {{ $contador }}
                                    </td>
                                    <td class="px-6 py-4 flex items-center">
                                        <a href="{{ route('peliculas.show', $pelicula) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-3">Ver</a>
                                        <a href="{{ route('peliculas.edit', $pelicula) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                        <form method="POST" action="{{ route('peliculas.destroy', $pelicula) }}">
                                            @method('DELETE')
                                            @csrf
                                            <a href="{{ route('peliculas.destroy', $pelicula) }}"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"
                                                onclick="event.preventDefault(); if (confirm('¿Está seguro?')) this.closest('form').submit();">
                                                Eliminar
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6 text-center">
                        <a href="{{ route('peliculas.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Crear una nuevo pelicula
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        {{-- Paginación --}}
<div class="mt-6 flex justify-center">
    {{ $peliculas->links() }}
</div>
</x-app-layout>
