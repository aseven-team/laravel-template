<?php

namespace App\Modules\Accounts\Http\Controllers;

use App\Modules\Accounts\Http\Requests\UserLoginRequest;
use App\Modules\Accounts\Http\Resources\UserLoginResource;
use App\Modules\Accounts\Services\UserAuthService;
use Exception;
use Illuminate\Http\JsonResponse;

class UserAuthController extends Controller
{
    public function __construct(
        private UserAuthService $userAuthService,
    ) {}

    public function login(UserLoginRequest $request): JsonResponse
    {
        try {
            $result = $this->userAuthService->login(...$request->validated());

            return $this->sendData([
                'token' => $result['token'],
                'user' => new UserLoginResource($result['user']),
            ]);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function logout(): JsonResponse
    {
        $this->userAuthService->logout();

        return $this->sendOk();
    }
}
