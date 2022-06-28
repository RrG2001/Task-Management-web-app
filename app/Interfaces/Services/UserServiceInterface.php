<?php

namespace App\Interfaces\Services;

interface UserServiceInterface
{
    public function addUser($request);
    public function register($request);
    public function login($request);
    public function forgotPassword($request);
    public function resetPassword($request);
}
