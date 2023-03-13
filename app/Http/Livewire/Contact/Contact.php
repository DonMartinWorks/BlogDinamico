<?php

namespace App\Http\Livewire\Contact;

use App\Http\Livewire\Traits\Notification;
use App\Http\Livewire\Traits\SlideOver;
use App\Models\PersonalInformation;
use Livewire\Component;

class Contact extends Component
{
    use Notification,SlideOver;

    public PersonalInformation $contact;

    protected $rules = ['contact.email' => 'required|email:filter'];

    // Para traer el email para la vista
    public function mount()
    {
        $this->contact = PersonalInformation::first() ?? new PersonalInformation();
    }

    //Si, este metodo es para editar el email
    public function edit()
    {
        $this->validate();

        $this->contact->save();

        $this->reset('openSlideOver');
        $this->notify(__('Contact email updated successfully!'));
    }

    public function render()
    {
        return view('livewire.contact.contact');
    }
}
