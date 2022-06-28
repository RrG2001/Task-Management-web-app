<?php

namespace App\Services;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\interfaces\Services\UserServiceInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
            'userRole' => $request->userRole,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ];
        return $this->userRepository->create($userData);
    }

    public function register($request)
    {
        $request->validate([
            'username' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);
        $registerData = [
            'userRole' => $request->userRole,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $userData = $this->userRepository->create($registerData);
        if ($userData) {
            $user = $this->userRepository->findById($userData->id);
            $token = $user->createToken('authToken')->accessToken;
            $user->update(['recent_login' => Carbon::now()->timestamp]);
            setcookie("laraToken", $token, "/", env('APP_DOMAIN'));
        }
    }

    public function login($request)
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            throw new NotFoundHttpException('Email or password are incorrect.');
            $remember = true;
            Auth::login($user, $remember);
        }
        $userData = Auth::getUser();
        $token = $userData->createToken('authToken')->accessToken;
        $userData->update(['recent_login' => Carbon::now()->timestamp]);
        setcookie("laraToken", $token, "/", env('APP_DOMAIN'));
        return ['user' => $userData, 'token' => $token];
    }

    public function forgotPassword($request)
    {
        return Password::sendResetLink(
            $request->only('email')
        );
    }

    public function resetPassword($request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'

        ]);

        $passwordReset = DB::table('password_resets')->where(['email' => $request->email])->first();
        if ($passwordReset) {

            return true;
        }

        return false;
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
