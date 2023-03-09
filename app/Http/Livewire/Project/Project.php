<?php

namespace App\Http\Livewire\Project;

use App\Http\Livewire\Traits\Notification;
use App\Http\Livewire\Traits\SlideOver;
use App\Http\Livewire\Traits\WithImageFile;
use App\Models\Project as ProjectModel;
use Livewire\Component;
use Livewire\WithFileUploads;

class Project extends Component
{
    use Notification, SlideOver, WithImageFile, WithFileUploads;

    public ProjectModel $currentProject;
    public bool $openModal = false;

    protected $rules = [
        'currentProject.name' => 'required|max:100',
        'currentProject.description' => 'required|max:450',
        'imageFile' => 'nullable|image|max:1024',
        'currentProject.video_link' => ['nullable', 'url', 'regex:/^(https|http):\/\/(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)[A-z0-9-]+/i'],
        'currentProject.url' => 'nullable|url',
        'currentProject.repo_url' => ['nullable', 'url', 'regex:/^(https|http):\/\/(www\.)?(github|gitlab)\.com\/[A-z0-9-\/?=&]+/i'],
    ];

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

        //Si modal es falso es por que se va a editar el project
        if (!$modal) {
            $this->openSlide();
        }
    }

    public function create()
    {
        if ($this->currentProject->getKey()) {
            $this->currentProject = new ProjectModel();
        }

        $this->openSlide();
    }

    public function save()
    {
        $this->validate();

        //Este metodo tambien se usa para editar el project
        if ($this->imageFile) {
            //Si se actualiza la imagen elimina la imagen anterior del project
            $this->deleteFile('projects', $this->currentProject->image);
            //Reemplaza la imagen.
            $this->currentProject->image = $this->imageFile->store('/', 'projects');
        }

        $this->currentProject->save();

        $this->reset(['imageFile', 'openSlideOver']);

        $this->notify(__('Project saved successfully!'));
    }

    public function render()
    {
        $projects = ProjectModel::get();

        return view('livewire.project.project', ['projects' => $projects]);
    }
}
