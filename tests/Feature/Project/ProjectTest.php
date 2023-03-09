<?php

namespace Tests\Feature\Project;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Project\Project;
use App\Models\Project as ProjectModel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba encargada de corroborar el renderizado del componente.
     *
     * @test
     */
    public function project_component_can_be_rendered()
    {
        $this->get('/')->assertStatus(200)->assertSeeLivewire('project.project');
    }

    /**
     * Prueba encargada de corroborar el cargar los proyectos.
     *
     * @test
     */
    public function project_can_load_projects()
    {
        $projects = ProjectModel::factory(2)->create();

        Livewire::test(Project::class)
            ->assertSee($projects->first()->name)
            ->assertSee($projects->first()->image)
            ->assertSee($projects->last()->name)
            ->assertSee($projects->last()->image);
    }

    /**
     * Prueba encargada de corroborar el cargar los proyectos.
     *
     * @test
     */
    public function user_can_see_all_project_info()
    {
        $project = ProjectModel::factory()->create([
            'image' => 'myproject.jpg',
            'video_link' => 'https://www.youtube.com/watch?v=S9F0TxFy3qE',
            'url' => 'https://www.google.com/',
            'repo_url' => 'https://github.com/DonMartinWorks',
        ]);

        Livewire::test(Project::class)
            ->call('loadProject', $project->id)
            ->assertSee($project->name)
            ->assertSee($project->description)
            ->assertSee($project->image)
            ->assertSee($project->video_code)
            ->assertSee($project->url)
            ->assertSee($project->repo_url);
    }

    /**
     * Prueba encargada de corroborar que solo el usuario pueda ver los botones de acciones en proyects.
     *
     * @test
     */
    public function only_admin_can_see_projects_actions()
    {
        $user = User::factory()->create();
        $project = ProjectModel::factory(3)->create();

        Livewire::actingAs($user)->test(Project::class)
            ->assertStatus(200)
            ->assertSee(__('New Project'))
            ->assertSee(__('Edit Project'))
            ->assertSee(__('Delete'));
    }

    /**
     * Prueba encargada de corroborar que los invitados NO puedan ver los botones de acciones en proyects.
     *
     * @test
     */
    public function guests_cannot_see_projects_actions()
    {
        $this->markTestSkipped('Uncomment This!');

        // Livewire::test(Project::class)
        //     ->assertStatus(200)
        //     ->assertDontSee(__('New Project'))
        //     ->assertDontSee(__('Edit Project'))
        //     ->assertDontSee(__('Delete'));

        // $this->assertGuest();
    }

    /**
     * Prueba encargada de corroborar que solo el usuario pueda crear un nuevo project.
     *
     * @test
     */
    public function admin_can_add_a_project()
    {
        $user = User::factory()->create();
        $image = UploadedFile::fake()->image('project.jpg');
        Storage::fake('projects');

        Livewire::actingAs($user)->test(Project::class)
            ->set('currentProject.name', 'Super Project')
            ->set('currentProject.description', 'Lorem Ipsum is simply dummy')
            ->set('imageFile', $image)
            ->set('currentProject.video_link', 'https://www.youtube.com/watch?v=Cga7vReLoNc')
            ->set('currentProject.url', 'https://www.facebook.com/')
            ->set('currentProject.repo_url', 'https://github.com/DonMartinWorks/BlogDinamico')
            ->call('save');

        $newProject = ProjectModel::first();

        $this->assertDatabaseHas('projects', [
            'id' => $newProject->id,
            'name' => 'Super Project',
            'description' => 'Lorem Ipsum is simply dummy',
            'image' => $newProject->image,
            'url' => $newProject->url,
            'video_link' => $newProject->video_link,
            'repo_url' => $newProject->repo_url,
        ]);

        //Corroborar que se guardo la imagen
        Storage::disk('projects')->assertExists($newProject->image);
    }

    /**
     * Prueba encargada de corroborar que solo el usuario pueda editar un project existente.
     *
     * @test
     */
    public function admin_can_edit_a_project()
    {
        $user = User::factory()->create();
        $project = ProjectModel::factory()->create();
        $img = UploadedFile::fake()->image('mysuperimg.jpg');
        Storage::fake('projects');

        Livewire::actingAs($user)->test(Project::class)
            ->call('loadProject', $project->id)
            ->set('currentProject.name', 'My super project updated')
            ->set('currentProject.description', 'Software Developed with Laravel PHP and a lot of love')
            ->set('imageFile', $img)
            ->set('currentProject.video_link', 'https://www.youtube.com/watch?v=CRpsb5xCZLw&t=179s')
            ->set('currentProject.url', 'https://www.google.cl/')
            ->set('currentProject.repo_url', 'https://github.com/DonMartinWorks/BlogDinamico')
            ->call('save');

        $project->refresh();

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'name' => 'My super project updated',
            'description' => 'Software Developed with Laravel PHP and a lot of love',
            'image' => $project->image,
            'video_link' => $project->video_link,
            'url' => $project->url,
            'repo_url' => 'https://github.com/DonMartinWorks/BlogDinamico',
        ]);

        Storage::disk('projects')->assertExists($project->image);
    }
}
