<?php

namespace App\Http\Livewire\Project;

use App\Models\Project as ProjectModel;
use Livewire\Component;


class Project extends Component
{
    public ProjectModel $currentProject;
    public bool $openModal = false;

    public function mount()
    {
        $this->currentProject = new ProjectModel();
    }

    /**
     * Este metodo sirve para cargar el project, para ver el proyecto seleccionado.
     */
    public function loadProject(ProjectModel $project, $modal = true)
    {
        if ($this->currentProject->isNot($project)) {
            $this->currentProject = $project;
        }

        $this->openModal = $modal;
    }

    public function render()
    {
        $projects = ProjectModel::get();

        return view('livewire.project.project', ['projects' => $projects]);
    }
}
