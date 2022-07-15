<?php

namespace App\Repositories;

use App\Interfaces\Repositories\TaskUserRepositoryInterface;
use App\Models\TaskUser;

class TaskUserRepository extends BaseRepository implements TaskUserRepositoryInterface
{
    public function __construct(TaskUser $model)
    {
        parent::__construct($model);
    }

}
