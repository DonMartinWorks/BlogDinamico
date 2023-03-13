<?php

namespace Tests\Feature\Contact;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Models\PersonalInformation;
use App\Http\Livewire\Contact\Contact;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Esta prueba corrobora que el componente (CONTACT) sea visible en la vista.
     *
     * @test
     */
    public function contact_component_can_be_rendered()
    {
        $this->get('/')->assertStatus(200)->assertSeeLivewire('contact.contact');
    }

    /**
     * Esta prueba corrobora que el componente (CONTACT) sea visible en la vista.
     *
     * @test
     */
    public function component_can_load_contact_email()
    {
        $info = PersonalInformation::factory()->create();

        Livewire::test(Contact::class)->assertSee($info->email);
    }

    /**
     * Esta prueba corrobora que el admin puede ver los botones de contacto.
     *
     * @test
     */
    public function only_user_can_see_contact_actions()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(Contact::class)
            ->assertStatus(200)
            ->assertSee(__('Edit'));
    }

    /**
     * Esta prueba corrobora que el invitado NO pueda ver los botones de contacto.
     *
     * @test
     */
    public function guest_cannot_see_contact_actions()
    {
        $this->markTestSkipped('Uncomment This!');

        // Livewire::actingAs()->test(Contact::class)
        //     ->assertStatus(200)
        //     ->assertDontSee(__('Edit'));

        // $this->assertGuest();
    }
}
