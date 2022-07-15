<?php

namespace App\Interfaces\Services;

interface TaskServiceInterface
{
    public function store($request);
    public function getTaskById($taskId);
    public function updateById($request, $taskId);
    public function deleteTask($taskId);

}
