<?php

namespace Tests\Feature\Navigation;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Navitem;
use App\Http\Livewire\Navigation\Navigation;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NavigationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Esta prueba corrobora que el componente (NAVIGATION) sea visible en la vista.
     *
     * @test
     */
    public function navigation_component_can_be_rendered()
    {
        $this->get('/')->assertStatus(200)->assertSeeLivewire('navigation.navigation');
    }

    /**
     * Esta prueba se encarga de cargar y renderizar los enlaces a la vista.
     *
     * @test
     */
    public function component_can_load_items_navigation()
    {
        $items = Navitem::factory(3)->create();

        Livewire::test(Navigation::class)
        ->assertSee($items->first()->label)
        ->assertSee($items->first()->link);
    }
}
