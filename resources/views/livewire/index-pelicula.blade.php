<div>
    <!-- Filtro de búsqueda -->
    <input type="text" wire:model.live="search" placeholder="Buscar..." class="mb-4 px-4 py-2 border border-gray-300 rounded-lg">

    <select wire:model.live="searchField" class="mb-4 px-4 py-2 border border-gray-300 rounded-lg">
        <option value="titulo">titulo</option>
        <option value="director">director</option>
        <option value="duracion">duiracion</option>
        <option value="comentarios">comentarios</option>
    </select>

    <!-- Tabla de peliculas -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('titulo')">
                        titulo
                        @if ($sortField === 'titulo')
                            @if ($sortDirection === 'asc')
                                &#9650;
                            @else
                                &#9660;
                            @endif
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('director')">
                        director
                        @if ($sortField === 'director')
                            @if ($sortDirection === 'asc')
                                &#9650;
                            @else
                                &#9660;
                            @endif
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('duracion')">
                        duiracion
                        @if ($sortField === 'duracion')
                            @if ($sortDirection === 'asc')
                                &#9650;
                            @else
                                &#9660;
                            @endif
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('comentarios')">
                        comentarios
                        @if ($sortField === 'comentarios')
                            @if ($sortDirection === 'asc')
                                &#9650;
                            @else
                                &#9660;
                            @endif
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('comentarios')">
                        acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peliculas as $pelicula)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">{{ $pelicula->ficha->titulo }}</td>
                        <td class="px-6 py-4">{{ $pelicula->director }}</td>
                        <td class="px-6 py-4">{{ $pelicula->duracion }}</td>
                        <td class="px-6 py-4">{{ $pelicula->comentarios }}</td>
                        <td class="px-6 py-4">
                            <!-- Opciones -->
                            <a href="{{ route('peliculas.edit', $pelicula) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                            <form method="POST" action="{{ route('peliculas.destroy', $pelicula) }}" class="inline-block">
                                @method('DELETE')
                                @csrf
                                <a href="{{ route('peliculas.destroy', $pelicula) }}"
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"
                                    onclick="event.preventDefault(); if (confirm('¿Está seguro?')) this.closest('form').submit();">
                                    Eliminar
                                </a>
                            </form>
                            {{-- @if ($pelicula->plazasLibres())
                                <a href="{{ route('peliculas.reserva', $pelicula) }}" class="ml-3 font-medium text-blue-600 dark:text-blue-500 hover:underline">Reservar</a>
                            @endif --}}
                            @can('view', $pelicula)
                            <a href="{{ route('peliculas.reserva', $pelicula) }}" class="ml-3 font-medium text-blue-600 dark:text-blue-500 hover:underline">Reservar</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $peliculas->links() }}
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('peliculas.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Crear un nuevo pelicula
        </a>
    </div>
</div>
