<?php

namespace App\Http\Livewire\Hero;

use App\Models\PersonalInformation;
use Livewire\Component;

class Info extends Component
{
    public PersonalInformation $info;

    //Datos
    public $cvFile = null;
    public $imageFile = null;

    public function mount()
    {
        //Para traer el unico registro en PersonalInformation
        $this->info = PersonalInformation::first() ?? new PersonalInformation();
    }

    public function render()
    {
        return view('livewire.hero.info');
    }
}
