<?php

namespace App\Modules\Accounts\Services;

use App\Modules\Accounts\Models\User;
use App\Modules\Accounts\Repositories\Contracts\UserRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class UserAuthService
{
    public function __construct(
        private UserRepository $userRepository,
    ) {}

    /**
     * @throws AuthenticationException
     */
    public function login(string $username, string $password, string $device_name = null): array
    {
        $user = $this->userRepository->showByUsername($username);

        if (!$user || !Hash::check($password, $user->password)) {
            throw new AuthenticationException("Username or password incorrect.");
        }

        $token = $user->createToken($device_name ?? "Unknown device")->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }

    /**
     * @throws AuthenticationException
     */
    public function logout()
    {
        $user = $this->getAuthenticatedUser();
        $user->currentAccessToken()->delete();
    }

    /**
     * @throws AuthenticationException
     */
    public function getAuthenticatedUser(): User
    {
        $user = auth()->guard('users')->user();

        if (!$user instanceof User) {
            throw new AuthenticationException();
        }

        return $user;
    }
}
