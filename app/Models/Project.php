<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'video_link', 'url', 'repo_url'];

    protected function imageUrl(): Attribute
    {
        # Si el proyecto no tiene imagen toma la imagen por defecto para mostrar en la vista.
        return Attribute::make(
            get: fn () => Storage::disk('projects')->url($this->image ?? 'default-img-project.jpg'),
        );
    }
}
