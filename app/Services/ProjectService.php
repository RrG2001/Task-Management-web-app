<?php

namespace App\Services;

use App\Interfaces\Repositories\ProjectRepositoryInterface;
use App\Interfaces\Services\ProjectServiceInterface;
use Illuminate\Support\Str;


class ProjectService implements ProjectServiceInterface
{
    private $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function store($request)
    {
            $data = [
                'name' => $request->name
            ];

        return $this->projectRepository->create($data);
    }

    public function getProjectById($projectId)
    {
        return $this->projectRepository->findById($projectId);
    }

    public function updateById($request, $projectId)
    {
        $project = $this->projectRepository->findById($projectId);

        $data=[
            'name' => $request->name
        ];

        return $this->projectRepository->updateById($project->id, $data);
    }

    public function deleteProject($projectId)
    {
        $project = $this->projectRepository->findById($projectId);

        return $project ? $this->projectRepository->destroy($project->id) : false;
    }
}
