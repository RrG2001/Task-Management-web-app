<?php

namespace App\Repositories;

use App\Interfaces\Repositories\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    public function getFilteredTasks($request)
    {
        $projectId = $request->projectId;
        $userId = $request->userId;

        return $this->model
            ->where('project_id', $request->projectId)
            ->whereHas('users', function ($query) use ($projectId) {
                $query->where('user_id', $projectId);
            })
            ->with('users', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();
    }

    public function noAssignee($request)
    {
        return $this->model
            ->where('project_id', $request->projectId)
            ->whereDoesntHave('users')
            ->get();
    }
}
