<?php

namespace App\Http\Livewire\Navigation;

use App\Models\Navitem;
use Livewire\Component;

class Navigation extends Component
{
    public $items;
    public $openSlideOver = false;
    public $addNewItem = false;

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

    public function render()
    {
        return view('livewire.navigation.navigation');
    }
}
