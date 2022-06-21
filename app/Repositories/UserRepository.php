<?php

namespace App\Repositories;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function login($request)
    {
        return $this->model->where('email', $request->email)->where('password', $request->password)->first();
    }

    public function create($userData)
    {
        // TODO: Implement create() method.
    }
}