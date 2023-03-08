<?php

namespace Tests\Feature\Project;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Project\Project;
use App\Models\Project as ProjectModel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
}
