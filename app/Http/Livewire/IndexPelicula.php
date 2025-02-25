<?php

namespace App\Http\Livewire;

use App\Models\Pelicula;
use Livewire\Component;
use Livewire\WithPagination;

class IndexPelicula extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'titulo';
    public $sortDirection = 'asc';

    public $searchField = 'titulo';

    protected $queryString = ['search'];

    public function render()
    {
        //$peliculas = Pelicula::query()
        //     ->when(
        //        $this->search,
        //         function ($query) {

        //            return $query->where($this->searchField, 'ILIKE', "%{$this->search}%");
        //        }
        //    )
        //    ->orderBy($this->sortField, $this->sortDirection)
        //    ->paginate(5);

        $peliculas = Pelicula::query()
            ->join('fichas', 'fichas.fichable_id', '=', 'peliculas.id') // Asumiendo que 'fichable_id' es la clave foránea en 'fichas'
            ->when($this->search, function ($query) {
                return $query->whereHas('ficha', function ($query) {
                    $query->where($this->searchField, 'ILIKE', "%{$this->search}%");
                });
            })
            ->orderBy('fichas.titulo', $this->sortDirection) // Ordena por 'titulo' de 'fichas'
            ->paginate(5);

        return view('livewire.index-pelicula', [
            'peliculas' => $peliculas,
        ]);
    }
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
}
