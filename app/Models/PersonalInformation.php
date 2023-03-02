<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonalInformation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'cv', 'image', 'email'];

    /**
     * Esta funcion se encarga de del archivo PDF CV
     * Por defecto el archivo para mostrar es: my-cv.pdf
     * El archivo cuando es creado, es generado con una cadena aleatoria
     * Cuando se actualiza el archivo estara disponible para la visualizacion y descarga de
     * los invitados (usuarios no registrados en la plataforma).
     *
     * Si el archivo es nulo, declara al archivo con el archivo por defecto.
     */
    protected function cvUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::disk('cv')->url($this->cv ?? 'my-cv.pdf')
        );
    }
}
