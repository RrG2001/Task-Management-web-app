<?php

namespace App\Services;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\interfaces\Services\UserServiceInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function addUser($request)
    {
        $userData = [
            'userRole'=>$request->userRole,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        return $this->userRepository->create($userData);
    }

    public function register($request)
    {
        $user = [
          'username'=>$request->username,
          'email'=>$request->email,
          'password'=>$request->password
        ];
        return response()->json(['message'=>'User has been registered']);
    }

    public function login($request)
    {
        $credentials = User::where('email', $request->email)->where('password', $request->password);

        if($credentials){

            $token = $credentials->createToken('Personal Access Token')->accessToken;

            return response()->json([
                'user'=>$credentials,
                'access_token'=>$token
            ]);
        }
        return response()->json(['message'=>'Credentials given are incorrect']);
    }
}
