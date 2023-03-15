<?php

namespace App\Http\Livewire\Navigation;

use App\Models\Navitem;
use Livewire\Component;
use App\Http\Livewire\Traits\Notification;
use App\Http\Livewire\Traits\SlideOver;

class Navigation extends Component
{
    //Traits
    use Notification, SlideOver;

    public $items;

    protected $listeners = ['deleteItem', 'itemAdded' => 'updateDataAfterAddItem'];

    protected $rules = [
        'items.*.label' => 'required|max:20',
        'items.*.link'  => 'required|max:40',
    ];

    public function mount()
    {
        $this->items = Navitem::all();
    }


    /**
     * Para reiniciar el listado de los items
     */
    public function updateDataAfterAddItem()
    {
        $this->mount();
        $this->reset('openSlideOver');
    }

    /**
     * Este metodo actualiza de manera dinamica el item
     */
    public function edit()
    {
        //Validar los datos
        $this->validate();

        //Actualizar el item
        foreach ($this->items as $item) {
            $item->save();
        }

        //Cerrar el SlideOver
        $this->reset('openSlideOver');

        $this->emitTo('navigation.footer-link', 'itemsHaveBeenUpdated');

        //Notificacion
        $this->notify(__('Menu items have been updated!'));
    }

    public function deleteItem(Navitem $item) //PAra recibir el id del item y lo busque y elimine
    {
        $item->delete();

        //Recargar los  items
        $this->mount();

        $this->emitTo('navigation.footer-link', 'itemsHaveBeenUpdated');

        //Notificacion
        $this->notify(__('Menu item have been deleted!'), 'deleteMessage');
    }

    public function render()
    {
        return view('livewire.navigation.navigation');
    }
}
