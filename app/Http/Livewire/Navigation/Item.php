<?php

namespace App\Http\Livewire\Navigation;

use App\Http\Livewire\Traits\Notification;
use App\Models\Navitem;
use Livewire\Component;

class Item extends Component
{
    use Notification;

    public Navitem $item;

    protected $rules = [
        'item.label' => 'required|max:20',
        'item.link' => 'required|max:40'
    ];

    public function mount()
    {
        $this->item = new Navitem();
    }

    /**
     * Este metodo es el encargado de guardar los nuevos items.
     */
    public function save()
    {
        $this->validate();

        //Guardar el item
        $this->item->save();

        $this->emitTo('navigation.navigation', 'itemAdded');

        //Limpiar
        $this->mount();

        //Notificación
        $this->notify(__('The item has been created successfully!'));
    }

    public function render()
    {
        return view('livewire.navigation.item');
    }
}
