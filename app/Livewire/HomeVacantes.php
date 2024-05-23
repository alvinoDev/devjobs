<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use Livewire\Attributes\On;

class HomeVacantes extends Component
{
    public $termino;
    public $salario;
    public $categoria;

    protected $listeners = ['on-search'=> 'buscar'];
    // #[On('on-search')] // Tenemos la explicacion de cual evento usar en Obsidian

    public function buscar($termino, $categoria, $salario)
    {
        $this->termino = $termino;
        $this->categoria = $categoria;
        $this->salario = $salario;
    }

    public function render()
    {
        // $vacantes = Vacante::all();
        $vacantes = Vacante::when($this->termino, function($query){
            $query->where('titulo', 'LIKE', "%" . $this->termino . "%");
        })
        ->when($this->termino, function($query){
            $query->orWhere('empresa', 'LIKE', "%" . $this->termino . "%");
        })
        ->when($this->categoria, function($query){
            $query->where('categoria_id', $this->categoria);
        })
        ->when($this->salario, function($query){
            $query->where('salario_id', $this->salario);
        })
        ->paginate(15);

        return view('livewire.home-vacantes', [
            'vacantes' => $vacantes
        ]);
    }
}
