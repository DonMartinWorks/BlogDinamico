<?php

namespace App\Http\Livewire\Hero;

use Livewire\Component;
use App\Models\PersonalInformation;
use App\Http\Livewire\Traits\SlideOver;
use App\Http\Livewire\Traits\Notification;
use App\Http\Livewire\Traits\WithImageFile;
use Livewire\WithFileUploads;

class Info extends Component
{
    use Notification, SlideOver, WithFileUploads, WithImageFile;

    public PersonalInformation $info;

    //Datos
    public $cvFile = null;
    public $imageFile = null;

    protected $rules = [
        'info.title' => 'required|max:80',
        'info.description' => 'required|max:300',
        'cvFile' => 'nullable|mimes:pdf|max:1024',
        'imageFile' => 'nullable|image|max:1024',
    ];

    public function updatedCvFile()
    {
        $this->validate([
            'cvFile' => 'mimes:pdf|max:1024',
        ]);
    }

    public function mount()
    {
        //Para traer el unico registro en PersonalInformation
        $this->info = PersonalInformation::first() ?? new PersonalInformation();
    }

    //Para editar los datos
    public function edit()
    {
        $this->validate();
        //Guarda title y description
        $this->info->save();

        # Seccion de eliminado/actualizacion de los archivos.

        /**
         * Si se usuario quiere cambiar el archivo: (hay que hacer)
         *
         * 1- Verificar si el usuario quiere cambiar el archivo
         * 2- El archivo que se subira ya esta validado por las reglas
         * 3- El archivo anterior debe ser eliminado
         * 4- El archivo se reemplaza y se guarda
         * 5- Este sera utilizado para que los visitantes puedan ver o descargar el PDF.
         * 6- El archivo por defecto no sera borrado
         */
        if ($this->cvFile) {
            # Elimina el archivo
            $this->deleteFile(disk: 'cv', filename: $this->info->cv);
            $this->info->update(['cv' => $this->cvFile->store('/', 'cv')]);
        }

        if ($this->imageFile) {
            # Elimina el archivo
            $this->deleteFile(disk: 'hero', filename: $this->info->image);
            $this->info->update(['image' => $this->imageFile->store('/', 'hero')]);
        }

        # Seccion de eliminado/actualizacion de los archivos.

        $this->resetExcept('info');

        //Notificacion
        $this->notify(__('Information saved sucessfully!'));
    }

    public function render()
    {
        return view('livewire.hero.info');
    }
}
