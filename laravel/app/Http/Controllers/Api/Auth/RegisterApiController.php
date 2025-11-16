<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisteredUserRequest;
use App\Services\RegisteredUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterApiController extends Controller {
    protected RegisteredUserService $service;

    public function __construct(RegisteredUserService $service) {
        $this->service = $service;
    }

    public function store(RegisteredUserRequest $request): JsonResponse {
        $data = $request->validated();

        $user = $this->service->register($data);

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'message' => 'Usuário registrado com sucesso!',
            'token' => $token,
        ], 201);
    }
}
