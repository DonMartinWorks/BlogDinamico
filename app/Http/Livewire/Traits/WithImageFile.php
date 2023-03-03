<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Support\Facades\Storage;

/**
 * Este Trait tiene la funcion de eliminar los archvios que reciba, siempre y cuando exista realmente el archivo
 *
 * *Datos Necesarios*:
 *   disk y fileName
 *
 * Estos mensajes son traidos desde app.js que es el archivo donde esta la configuracion
 */

trait WithImageFile
{
    public $imageFile = null;

    public function updatedImageFile()
    {
        $this->validate([
            'imageFile' => 'image|max:1024',
        ]);
    }

    public function deleteFile($disk, $filename)
    {
        //Si el archivo no es nulo y si existe continua
        if ($filename && Storage::disk($disk)->exists($filename)) {
            Storage::disk($disk)->delete($filename);
        }
    }
}
