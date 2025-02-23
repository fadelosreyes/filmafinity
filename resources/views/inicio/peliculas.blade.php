
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            peliculas
        </h2>
    </x-slot>

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
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
