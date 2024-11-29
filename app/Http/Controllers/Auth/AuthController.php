<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Services\UserService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function login(LoginUserRequest $loginUserRequest): Application|Response|JsonResponse|ResponseFactory
    {
        $credentials = $loginUserRequest->validated();

        if($credentials) {
            if (Auth::attempt($credentials)) {
                $loginUserRequest->session()->regenerate();

                return response()->noContent();
            }
        }

        return response('Неправильные логин или пароль', ResponseAlias::HTTP_BAD_REQUEST);
    }

    public function register(RegisterUserRequest $request): Application|Response|ResponseFactory
    {
        if($credentials = $request->validated()) {
            $user = $this->userService->createUser($credentials);

            Auth::login($user);

            return response($user, ResponseAlias::HTTP_CREATED);
        }

        return response("Bad Request", ResponseAlias::HTTP_BAD_REQUEST);
    }

    public function logout(Request $request): Response
    {
        Auth::logout();

        $request->session()->invalidate();

        return response()->noContent();
    }
}
