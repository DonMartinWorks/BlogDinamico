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

    /**
     * Esta prueba corrobora que el usuario pueda crear un social link.
     *
     * @test
     */
    public function admin_can_add_a_social_link()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(SocialLink::class)
            ->set('socialLink.name', 'Youtube')
            ->set('socialLink.url', 'https://youtube.com/profile')
            ->set('socialLink.icon', 'fa-brands fa-youtube')
            ->call('save');

        $this->assertDatabaseHas('social_links', [
            'name' => 'Youtube',
            'url' => 'https://youtube.com/profile',
            'icon' => 'fa-brands fa-youtube'
        ]);
    }

    /**
     * Esta prueba corrobora que el usuario pueda crear un social link.
     *
     * @test
     */
    public function admin_can_edit_a_social_link()
    {
        $user = User::factory()->create();
        $socialLink = SocialLinkModel::factory()->create();

        Livewire::actingAs($user)->test(SocialLink::class)
            ->set('socialLinkSelected', $socialLink->id)
            ->set('socialLink.name', 'Github')
            ->set('socialLink.url', 'https://github.com/DonMartinWorks')
            ->set('socialLink.icon', 'fa-brands fa-github')
            ->call('save');

        $socialLink->refresh();

        $this->assertDatabaseHas('social_links', [
            'id' => $socialLink->id,
            'name' => 'Github',
            'url' => 'https://github.com/DonMartinWorks',
            'icon' => $socialLink->icon,
        ]);
    }

    /**
     * Esta prueba corrobora que el usuario pueda eliminar un social link.
     *
     * @test
     */
    public function admin_can_delete_a_social_link()
    {
        $user = User::factory()->create();
        $socialLink = SocialLinkModel::factory()->create();

        Livewire::actingAs($user)->test(SocialLink::class)
            ->set('socialLinkSelected', $socialLink->id)
            ->call('deleteSocialLink');

        $this->assertDatabaseMissing('social_links', ['id' => $socialLink->id]);
    }

    /**
     * Esta prueba corrobora que el nombre de social link es requerido.
     *
     * @test
     */
    public function name_is_required()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(SocialLink::class)
            ->set('socialLink.name', '')
            ->call('save')
            ->assertHasErrors(['socialLink.name' => 'required']);
    }

    /**
     * Esta prueba corrobora que el nombre de social link no supere los 20 caracteres.
     *
     * @test
     */
    public function name_must_have_a_maximum_of_twenty_characters()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(SocialLink::class)
            ->set('socialLink.name', '123456789012345678901')
            ->call('save')
            ->assertHasErrors(['socialLink.name' => 'max']);
    }

    /**
     * Esta prueba corrobora que la url de social link es requerido.
     *
     * @test
     */
    public function url_is_required()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(SocialLink::class)
            ->set('socialLink.url', '')
            ->call('save')
            ->assertHasErrors(['socialLink.url' => 'required']);
    }

    /**
     * Esta prueba corrobora que la url de social link sea un link valido.
     *
     * @test
     */
    public function url_must_be_a_valid_url()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(SocialLink::class)
            ->set('socialLink.url', 'ertretretr')
            ->call('save')
            ->assertHasErrors(['socialLink.url' => 'url']);
    }

    /**
     * Esta prueba corrobora que el iccno sea un icono valido
     * de font awesome (Ejemplo: fa-brands fa-twitter).
     *
     * @test
     */
    public function icon_must_match_with_regex()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(SocialLink::class)
            ->set('socialLink.icon', 'fa-fa fa-face-smile-wink')
            ->call('save')
            ->assertHasErrors(['socialLink.icon' => 'regex']);
    }
}
