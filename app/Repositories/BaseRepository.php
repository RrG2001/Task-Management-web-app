<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getCurrentUser()
    {
        return auth('api')->user();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getAllByDescendedDate($column)
    {
        return $this->model->orderBy($column, 'desc')->get();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function updateById($id, $data)
    {
        return $this->model->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }
}
