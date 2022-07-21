<?php

namespace App\Services;

use App\Interfaces\Repositories\ProjectRepositoryInterface;
use App\Interfaces\Services\ProjectServiceInterface;

class ProjectService implements ProjectServiceInterface
{
    private $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function getProjectById($projectId)
    {
        return $this->projectRepository->findById($projectId);
    }

    public function getAll($projectId)
    {
        return $this->projectRepository->getAll($projectId);
    }

    public function getStatus($projectId, $statusId)
    {
        return $this->projectRepository->getStatus($projectId, $statusId);
    }

    public function getPriority($projectId, $priorityId)
    {
        return $this->projectRepository->getPriority($projectId, $priorityId);
    }

    public function sortProjectUsers($userId)
    {
        $project = $this->projectRepository->sortProjectUsers($userId);
        $tempArray = [];

        $projectTasks = $project->tasks;
        foreach ($projectTasks as $projectTask) {
            foreach ($projectTask->users as $user) {
                if ($user->id == $userId) {
                    $tempArray[] = $project;
                }
            }
        }

        return $tempArray;
    }

    public function updateById($request, $projectId)
    {
        $project = $this->projectRepository->findById($projectId);

        $data = [
            'name' => $request->name
        ];

        return $this->projectRepository->updateById($project->id, $data);
    }

    public function deleteProject($projectId)
    {
        $project = $this->projectRepository->findById($projectId);

        return $project ? $this->projectRepository->destroy($project->id) : false;
    }

    public function createMultipleProjects($request)
    {
        $projectsCreated = [];
        foreach ($request->name as $project) {
            $projects = [
                'name' => $project,
            ];

            $projectsCreated[] = $this->projectRepository->create($projects);
        }
        return $projectsCreated;
    }
}
