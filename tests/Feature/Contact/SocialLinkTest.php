<?php

namespace Tests\Feature\Contact;

use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SocialLinkTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Esta prueba corrobora que el componente (SOCIAL LINK) sea visible en la vista.
     *
     * @test
     */
    public function social_link_component_can_be_rendered()
    {
        $this->get('/')->assertStatus(200)->assertSeeLivewire('contact.social-link');
    }

    /**
     * Esta prueba corrobora que el componente (SOCIAL LINK) sea visible en la vista.
     *
     * @test
     */
    public function component_can_load_social_links()
    {
        $links = SocialLinkModel::factory(3)->create();

        Livewire::test(SocialLink::class)
            ->assertSee($links->first()->url)
            ->assertSee($links->first()->icon)
            ->assertSee($links->first()->url)
            ->assertSee($links->first()->icon);
    }
}
