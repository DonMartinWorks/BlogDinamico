<?php

namespace App\Http\Livewire\Hero;

use Livewire\Component;
use App\Models\PersonalInformation;
use App\Http\Livewire\Traits\SlideOver;
use App\Http\Livewire\Traits\Notification;

class Info extends Component
{
    use Notification, SlideOver;

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
