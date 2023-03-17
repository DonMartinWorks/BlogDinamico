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
        Livewire::test(Info::class)
            ->assertStatus(200)
            ->assertDontSee(__('Edit'));

        // ---  Para confirmar la visita como un visitante ---
        $this->assertGuest();
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

        $this->assertDatabaseHas('personal_information', [
            'id' => $info->id,
            'title' => 'First Name',
            'description' => 'Laravel lorem ipsum',
            'cv' => $info->cv,
            'image' => $info->image,
        ]);

        Storage::disk('hero')->assertExists($info->image);
        Storage::disk('cv')->assertExists($info->cv);
    }

    /**
     * Esta prueba corrobora que al repsionar el boton el usuario o el invitado puedan descargar el archivo PDF.
     *
     * @test
     */
    public function can_download_cv_file()
    {
        Livewire::test(Info::class)->call('download')->assertFileDownloaded('my-cv.pdf');
    }

    /**
     * Esta prueba se corrobora que title sea obligatorio.
     *
     * @test
     */
    public function title_is_required()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(Info::class)
            ->set('info.title', '')
            ->set('info.description', 'Description for information!')
            ->call('edit')
            ->assertHasErrors(['info.title' => 'required'])
            ->assertHasNoErrors(['info.description' => 'required']);
    }

    /**
     * Esta prueba se corrobora que title no supere los 80 caracteres.
     *
     * @test
     */
    public function title_must_have_a_maximum_of_eighty_characters()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Info::class)
            ->set('info.title', 'abdcefghijklmnopqrstuabdcefghijklmnopqrstabdcefghijklmnopqrstuabdcefghijklmnopqrs')
            ->set('info.description', 'This is a description')
            ->call('edit')
            ->assertHasErrors(['info.title' => 'max'])
            ->assertHasNoErrors(['info.description' => 'max']);
    }

    /**
     * Esta prueba se corrobora que description sea obligatorio.
     *
     * @test
     */
    public function description_is_required()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Info::class)
            ->set('info.title', 'This is a title')
            ->set('info.description', '')
            ->call('edit')
            ->assertHasNoErrors(['info.title' => 'required'])
            ->assertHasErrors(['info.description' => 'required']);
    }

    /**
     * Esta prueba se corrobora que description no supere los 300 caracteres.
     *
     * @test
     */
    public function description_must_have_a_maximum_of_three_hundred_characters()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Info::class)
            ->set('info.title', 'This is a title')
            ->set('info.description', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim suscipit hic eos quos rerum ratione totam animi eaque repellat dolorum nemo. Facere nulla error cumque porro voluptatem, maiores quasi rem! In incidunt, unde fugiat expedita vitae iste saepe delectus. Quam iste tempora iusto reprehenderit accusamus?')
            ->call('edit')
            ->assertHasNoErrors(['info.title' => 'max'])
            ->assertHasErrors(['info.description' => 'max']);
    }

    /**
     * Esta prueba corrobora que cv file deba de ser un archivo PDF.
     *
     * @test
     */
    public function cv_file_must_be_a_pdf()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Info::class)
            ->set('info.title', 'This is a title')
            ->set('info.description', 'This is a description')
            ->set('cvFile', UploadedFile::fake()->image('myimage.jpg'))
            ->call('edit')
            ->assertHasErrors(['cvFile' => 'mimes']);
    }

    /**
     * Esta prueba corrobora que cv file no supere 1 MB.
     *
     * @test
     */
    public function cv_file_cannot_exceed_one_megabyte()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Info::class)
            ->set('info.title', 'This is a title')
            ->set('info.description', 'This is a description')
            ->set('cvFile', UploadedFile::fake()->create('myfile.pdf', 1025))
            ->call('edit')
            ->assertHasErrors(['cvFile' => 'max']);
    }

    /**
     * Esta prueba corrobora que se suba una imagen a imageFile.
     *
     * @test
     */
    public function image_file_must_be_a_image()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Info::class)
            ->set('info.title', 'This is a title')
            ->set('info.description', 'This is a description')
            ->set('imageFile', UploadedFile::fake()->create('myfile.pdf'))
            ->call('edit')
            ->assertHasErrors(['imageFile' => 'image']);
    }

    /**
     * Esta prueba corrobora que imageFile no supere 1 MB.
     *
     * @test
     */
    public function image_file_cannot_exceed_one_megabyte()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Info::class)
            ->set('info.title', 'This is a title')
            ->set('info.description', 'This is a description')
            ->set('imageFile', UploadedFile::fake()->image('myimage.jpg')->size(1025))
            ->call('edit')
            ->assertHasErrors(['imageFile' => 'max']);
    }
}
