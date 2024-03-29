<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
        $this->middleware('auth:api', ['except' => ['signIn', 'signUp']]);
    }

    public function signIn(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Usuário ou senha inválidos!'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function signUp(Request $request)
    {
        $request->merge([
            'hierarchy' => 1,
        ]);

        $userStore = $this->userService->store($request);

        if ($userStore->status() === 201) {
            return $this->signIn($request);
        }

        return $userStore;
    }

    public function me() {
        return response()->json(auth('api')->user());
    }

    public function logout() {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh() {
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
