<?php

namespace App\Http\Livewire\Navigation;

use App\Models\Navitem;
use Livewire\Component;
use App\Http\Livewire\Traits\Notification;


class Navigation extends Component
{
    use Notification;

    public $items;
    public $openSlideOver = false;
    public $addNewItem = false;

    protected $listeners = ['deleteItem'];

    protected $rules = [
        'items.*.label' => 'required|max:20',
        'items.*.link'  => 'required|max:40',
    ];

    public function mount()
    {
        $this->items = Navitem::all();
    }

    /**
     * Este componente recibe TRUE al crear un nuevo item
     * Este componente recibe FALSE al editar un item existente
     */
    public function openSlide($addNewItem = false)
    {
        //El evento cuando sea disparado cambiara el estado de addNewItem de false a true para abrir el modal en el lado derecho.
        $this->addNewItem = $addNewItem;
        $this->openSlideOver = true;
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

        //Notificacion
        $this->notify(__('Menu items have been updated!'));
    }

    public function deleteItem(Navitem $item) //PAra recibir el id del item y lo busque y elimine
    {
        $item->delete();

        //Recargar los  items
        $this->mount();

        //Notificacion
        $this->notify(__('Menu item have been deleted!'), 'deleteMessage');
    }

    public function render()
    {
        return view('livewire.navigation.navigation');
    }
}
