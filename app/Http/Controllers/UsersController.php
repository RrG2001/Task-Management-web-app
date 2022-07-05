<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsersResources;
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

    public function read($userId)
    {
        return new UsersResources($this->userService->getUserById($userId));
    }

    public function register(Request $request)
    {
        return $this->userService->register($request);
    }

    public function login(Request $request)
    {
        return $this->userService->login($request);
    }

    public function forgotPassword(Request $request)
    {
        return $this->userService->forgotPassword($request);
    }

    public function resetPassword(Request $request)
    {
        $resetPassword = $this->userService->resetPassword($request);

        return $resetPassword
            ? response()->json(['message' => 'Password reset successfully'])
            : response()->json(['message' => 'Invalid token!']);
    }
}
