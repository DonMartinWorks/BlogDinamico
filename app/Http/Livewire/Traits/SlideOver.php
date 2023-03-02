<?php

namespace App\Http\Livewire\Traits;

/**
 * Este trait tiene la tarea de encargarse de ABRIR el SlideOver.
 */
trait SlideOver
{
    public $openSlideOver = false;
    public $addNewItem = false;

    // Abre el modal

    public function openSlide($addNewItem = false)
    //El evento cuando sea disparado cambiara el estado de addNewItem de false a true para abrir el modal en el lado derecho.
    {
        $this->addNewItem = $addNewItem;
        $this->openSlideOver = true;    // Con el valor true abre el modal, obviamente si es false lo cierra
    }
}
