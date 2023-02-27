<?php

namespace App\Http\Livewire\Traits;

/**
 * Este Trait tiene la funcion de llamar a las notificaciones (SweetAlert),
 * Según lo recibido por el event envia el tipo de diseño y notificacion
 * para ser mostrado en el browser. (El por defecto es el notify) (este valor es opcional)
 *
 * *Notificaciones aceptadas*:
 *   notify y deleteMessage
 *
 * Estos mensajes son traidos desde app.js que es el archivo donde esta la configuracion
 */

trait Notification
{
    public function notify($message = '', $event = 'notify')
    {
        //Notificacion
        $this->dispatchBrowserEvent($event, ['message' => $message]);
    }
}
