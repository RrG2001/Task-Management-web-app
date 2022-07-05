<?php

namespace App\Repositories;

use App\Interfaces\Repositories\Repositories\UserRepositoryInterface;
use App\Interfaces\Repositories\TaskRepositoryInterface;
use App\Models\Task;
use App\Models\User;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

}
