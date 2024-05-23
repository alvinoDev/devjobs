<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class MostrarVacantes extends Component
{
    #[On('on-delete')]
    public function eliminarVacante( Vacante $vacante )
    {
        Gate::authorize('delete', $vacante);

        $vacante->delete(); // Elimina la vacante
        Storage::delete(['public/vacantes/' . $vacante->imagen]); //Elimina la imagen
        
    }

    public function render()
    {

        $vacantes = Vacante::where('user_id', auth()->user()->id)->paginate(10);
        return view('livewire.mostrar-vacantes', ['vacantes' => $vacantes]);
    }
}
