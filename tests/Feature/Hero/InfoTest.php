<?php

namespace Tests\Feature\Hero;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\PersonalInformation;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InfoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Esta prueba corrobora que el componente (HERO) sea visible en la vista.
     *
     * @test
     */
    public function hero_info_component_can_be_rendered()
    {
        $this->get('/')->assertStatus(200)->assertSeeLivewire('hero.info');
    }

    /**
     * Esta prueba corrobora que el usuario pueda cargar informacion nueva a la vista.
     *
     * @test
     */
    public function component_can_load_hero_information()
    {
        $info = PersonalInformation::factory()->create();

        Livewire::test(Info::class)
            ->assertSee($info->title)
            ->assertSee($info->description);
    }
}
