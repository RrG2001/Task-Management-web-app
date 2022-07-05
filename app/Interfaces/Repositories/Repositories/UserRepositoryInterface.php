<?php

namespace App\Interfaces\Repositories\Repositories;

interface UserRepositoryInterface
{
    public function login($request);
    public function resetPassword($request);
}
