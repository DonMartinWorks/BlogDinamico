<?php

namespace Tests\Feature\Hero;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Hero\Info;
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

    /**
     * Esta prueba corrobora que solo el usuario admin pueda mirar los botones (enlaces) con
     * las acciones para editar la informacion.
     *
     * @test
     */
    public function only_user_admin_can_see_actions()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(Info::class)
            ->assertStatus(200)
            ->assertSee(__('Edit'));
    }

    /**
     * Esta prueba corrobora que los invitados NO pueda mirar los botones (enlaces) con
     * las acciones para editar la informacion.
     *
     * @test
     */
    public function guests_cannot_see_actions()
    {
        $this->markTestSkipped('Uncomment This!');
        //     Livewire::test(Info::class)
        //         ->assertStatus(200)
        //         ->assertDontSee(__('Edit'));

        // ---  Para confirmar la visita como un visitante ---
        //     $this->assertGuest();
    }
}
