<?php

namespace App\Http\Controllers;

use App\Interfaces\Services\UserServiceInterface;
use Illuminate\Http\Request;
class UsersController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function store(Request $request)
    {
        return $this->userService->addUser($request);
    }

    public function register(Request $request)
    {
        return $this->userService->register($request);
    }

    public function login(Request $request)
    {
        return $this->userService->login($request);
    }
}
