<?php

namespace App\Services;

use App\Interfaces\Repositories\ProjectRepositoryInterface;
use App\Interfaces\Repositories\TaskRepositoryInterface;
use App\Interfaces\Services\TaskServiceInterface;
use Illuminate\Support\Str;


class TaskService implements TaskServiceInterface
{
    private $taskRepository;
    private $projectRepository;

    public function __construct
    (
        TaskRepositoryInterface $taskRepository,
        ProjectRepositoryInterface $projectRepository
    )
    {
        $this->taskRepository = $taskRepository;
        $this->projectRepository = $projectRepository;
    }

    public function store($request)
    {
        $project = $this->projectRepository->findById($request->projectId);

        $uuid = Str::uuid();
        $taskData = [
            'custom_id' => $uuid,
            'project_id' => $project->id,
            'title'=> $request ->title,
            'description' => $request->description,
            'status' => $request->status,
            'time_estimation' => $request->timeEstimation,
            'priority' => $request->priority,
            'reporter' => $request->reporter
        ];

        return $this->taskRepository->create($taskData);
    }

    public function getTaskById($taskId)
    {
        return $this->taskRepository->findById($taskId);
    }

    public function updateById($request, $taskId)
    {
        $uuid = Str::uuid();

        $task = $this->taskRepository->findById($taskId);
        $data=[
            'project_id'=> $request->projectId,
            'customId' => $uuid,
            'title'=> $request ->title,
            'description' => $request->description,
            'status' => $request->status,
            'timeEstimation' => $request->timeEstimation,
            'priority' => $request->priority,
            'reporter' => $request->reporter
        ];

        return $this->taskRepository->updateById($task->id, $data);
    }

    public function deleteTask($taskId)
    {
        $task = $this->taskRepository->findById($taskId);

        return $task ? $this->taskRepository->destroy($task->id) : false;
    }
}
