<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            peliculas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('index-pelicula') <!-- Aquí insertas el componente Livewire -->
        </div>
    </div>

</x-app-layout>
