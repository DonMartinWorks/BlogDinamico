<?php

namespace App\Http\Livewire\Hero;

use Livewire\Component;
use App\Models\PersonalInformation;
use Illuminate\Support\Facades\Storage;

class Image extends Component
{
    private string $image = 'default-hero.jpg';

    protected $listeners = ['heroImageUpdated' => 'mount'];

    public function mount()
    {
        $info = PersonalInformation::select('image')->first();

        # Sie ne la tabla no hay nada vuleva a utilizar la imagen por defecto...
        if (!is_null($info) && !is_null($info->image)) {
            //Si en la db no existe un nombre de la imagen, utiliza la imagen por defecto...
            $this->image = PersonalInformation::select('image')->first()->image ?? 'default-hero.jpg';
        }
    }

    //Propiedad con la finalidad de traer la url de la imagen para mostrar esta en la vista
    public function getImageUrlProperty()
    {
        return Storage::disk('hero')->url($this->image);
    }

    public function render()
    {
        return view('livewire.hero.image');
    }
}
