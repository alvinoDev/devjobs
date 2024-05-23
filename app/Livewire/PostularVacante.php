<?php

namespace App\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    use WithFileUploads;
    public $cv;
    public $vacante;

    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];


    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    public function postularme()
    {
        $datos = $this->validate();

        //Almacenar CV en el disco duro
        $cv_path = $this->cv->store('public/cv');
        $nombre_cv = str_replace('public/cv/', '', $cv_path);

        //Crear el candidato a la vacante (Como lo relacione con Vacante ya sabe el vacante_id automaticamene lo asigna)
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
            'cv' => $nombre_cv
        ]);

        //Crear notificacion y enviar correo
        $this->vacante->reclutador->notify(New NuevoCandidato( $this->vacante->id, $this->vacante->titulo, auth()->user()->id ));

        //Mostrar al usuario un mensaje de confirmacion
        session()->flash('mensaje', 'Se envió correctamente tu información, mucha suerte.');

        return redirect()->back();

    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
