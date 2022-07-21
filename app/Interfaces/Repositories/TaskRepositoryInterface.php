<?php

namespace App\Interfaces\Repositories;

interface TaskRepositoryInterface
{
    public function getFilteredTasks($request);

    public function noAssignee($request);
}
