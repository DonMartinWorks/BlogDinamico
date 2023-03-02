<?php

namespace Tests\Feature\Hero;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Hero\Info;
use Illuminate\Http\UploadedFile;
use App\Models\PersonalInformation;
use Illuminate\Support\Facades\Storage;
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
     * Esta prueba corrobora que solo el usuario admin pueda mirar los botones
     * (enlaces) con las acciones para editar la informacion.
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

    /**
     * Esta prueba corrobora que solo el usuario admin pueda editar la informacion que
     * se muestra en la vista.
     *
     * @test
     */
    public function only_user_admin_can_edit_the_hero_information()
    {
        $user = User::factory()->create();
        $info = PersonalInformation::factory()->create();

        //Archivos falsos para la prueba
        $image = UploadedFile::fake()->image('hero.jpg');
        $cv = UploadedFile::fake()->create('vitae.pdf');
        Storage::fake('hero');
        Storage::fake('cv');

        Livewire::actingAs($user)->test(Info::class)
            ->set('info.title', 'First Name')
            ->set('info.description', 'Laravel lorem ipsum')
            ->set('cvFile', $cv)
            ->set('imageFile', $image)
            ->call('edit');

        $info->refresh();
    }
}
