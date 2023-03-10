<?php

namespace App\Http\Livewire\Contact;

use App\Models\PersonalInformation;
use Livewire\Component;

class Contact extends Component
{
    public PersonalInformation $contact;

    // Para traer el email para la vista
    public function mount()
    {
        $this->contact = PersonalInformation::select('email')->first() ?? new PersonalInformation();
    }

    public function render()
    {
        return view('livewire.contact.contact');
    }
}
