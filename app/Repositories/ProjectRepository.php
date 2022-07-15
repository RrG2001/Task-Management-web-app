<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ProjectRepositoryInterface;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    public function __construct(Project $model)
    {
        parent::__construct($model);
    }

    public function getAll($projectId)
    {
        return $this->model
            ->where('id', $projectId)
            ->whereHas('tasks')
            ->with('tasks')
            ->get();
    }

    public function getStatus($projectId, $statusId)
    {
        return $this->model
            ->where('id', $projectId)
            ->whereHas('tasks', function ($query) use ($statusId) {
                $query->where('status', $statusId);
            })
            ->with('tasks', function ($query) use ($statusId) {
                $query->where('status', $statusId);
            })
            ->first();
    }

    public function getPriority($projectId, $priorityId)
    {
        return $this->model
            ->where('id', $projectId)
            ->whereHas('tasks', function ($query) use ($priorityId) {
                $query->where('priority', $priorityId);
            })
            ->with('tasks', function ($query) use ($priorityId) {
                $query->where('priority', $priorityId);
            })
            ->first();
    }

    public function sortProjectUsers($userId)
    {
        return $this->model
            ->whereHas('tasks', function ($query) use ($userId) {
                $query->whereHas('users', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                });
            })
            ->with('tasks', function ($query) use ($userId) {
                $query->with('users', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                });
            })
            ->first();
    }
}
