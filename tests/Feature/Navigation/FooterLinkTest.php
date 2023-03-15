<?php

namespace Tests\Feature\Navigation;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Navitem;
use App\Http\Livewire\Navigation\FooterLink;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FooterLinkTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Esta prueba corrobora que el componente (FOOTER LINK) sea visible en la vista.
     *
     * @test
     */
    public function footer_link_component_can_be_rendered()
    {
        $this->get('/')->assertStatus(200)->assertSeeLivewire('navigation.footer-link');
    }

    /**
     * Esta prueba corrobora que el componente carge los
     * items en el footer de la vista.
     *
     * @test
     */
    public function component_can_load_items_navigation()
    {
        $items = Navitem::factory(3)->create();

        Livewire::test(FooterLink::class)
            ->assertSee($items->first()->label)
            ->assertSee($items->last()->label);
    }
}
