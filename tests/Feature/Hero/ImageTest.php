<?php

namespace Tests\Feature\Hero;

use App\Models\PersonalInformation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ImageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Esta prueba corrobora que el componente (IMAGE) sea visible en la vista.
     *
     * @test
     */
    public function hero_image_component_can_be_rendered()
    {
        Livewire::test('hero.image')->assertStatus(200);
    }

    /**
     * Esta prueba corrobora que la imagen sea cargada en el componente.
     *
     * @test
     */
    public function component_can_load_the_hero_image()
    {
        // $info = PersonalInformation::factory()->create();

        // Livewire::test('hero.image')->assertSee($info->image);

        Livewire::test('hero.image')->assertSee('default-hero.jpg');
    }
}
