<?php

namespace Tests\Feature\Contact;

use Tests\TestCase;
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
}
