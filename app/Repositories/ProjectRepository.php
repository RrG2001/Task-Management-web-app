<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ProjectRepositoryInterface;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;

class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    public function __construct(Project $model)
    {
        parent::__construct($model);
    }
}
