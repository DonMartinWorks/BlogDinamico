<?php

namespace Tests\Feature\Contact;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Contact\SocialLink;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\SocialLink as SocialLinkModel;
use App\Models\User;
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

    /**
     * Esta prueba corrobora que los botones sean vsibles para el usuario admin registrado.
     *
     * @test
     */
    public function only_admin_can_see_the_social_links_actions()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(SocialLink::class)
            ->assertStatus(200)
            ->assertSee(__('New'))
            ->assertSee(__('Edit'));
    }

    /**
     * Esta prueba corrobora que los botones NO sean vsibles para los invitados.
     *
     * @test
     */
    public function guests_cannot_see_the_social_links_actions()
    {
        $this->markTestSkipped('Uncomment This!');

        // Livewire::test(SocialLink::class)
        //     ->assertStatus(200)
        //     ->assertDontSee(__('New'))
        //     ->assertDontSee(__('Edit'));

        // $this->assertGuest();
    }
}
